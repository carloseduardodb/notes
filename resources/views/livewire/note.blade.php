<div class="border-2 border-white p-5 bg-white rounded w-6/12 shadow-lg relative" style="height: 600px; overflow-y: auto">
    <h2 class="border-b-2 border-gray-100 pb-3 font-bold text-2xl bg-gradient-to-r from-green-400 to-blue-500 text-white p-2 rounded">
        My Notes</h2>
    <div class="flex flex-col mt-2 mb-3">
        <label for="note">Type a note:</label>
        <input id="note" class="border-2 rounded p-1 mb-1 mt-1" type="text" wire:model="note">
        @error('note') <span class="font-light text-red-400">{{ $message }}</span> @enderror
        <div class="text-right mt-2">
            <button class="bg-blue-500 border-2 border-blue-500 p-1.5 text-white font-bold
            rounded hover:bg-white hover:text-blue-500" wire:click="create">Send
            </button>
        </div>
    </div>
    <div class="flex flex-col mt-2 mb-3 bg-gradient-to-r from-green-400 to-blue-500 p-4 rounded">
        <label for="search" class="text-white font-bold">Search:</label>
        <input id="search" class="border-2 rounded p-1 mb-1 mt-1" type="text" wire:model="search">
        @error('search') <span class="font-light text-red-400">{{ $message }}</span> @enderror
    </div>
    <div wire:loading class="mt-2 mb-2 flex rounded w-6/12 shadow-sm flex flex-row justify-center text-center" style="height: 30px">
        <span class="flex mt-2">
            <span class="animate-spin absolute left-0 ml-5 inline-flex h-full w-full rounded-full bg-green-400 opacity-75" style="max-width: 25px; max-height: 3px"></span>
        </span>
    </div>
    @foreach($notes as $note_list)
        <div class="mt-2 mb-2 flex border-2 border-blue-100 rounded w-6/12 shadow-sm w-full">
            <div class="flex items-center ml-2">
                <p class="font-bold mr-2">{{ $note_list->id }}</p>
                <p class="">{{ $note_list->note }}</p>
            </div>
            <div class="w-full flex justify-end">
                <button
                    class="bg-gradient-to-br from-blue-500 to-blue-700 p-2 text-white m-0 hover:from-blue-700 hover:to-blue-500"
                    wire:click="modal_open({{$note_list}})">Update
                </button>
                <button class="bg-red-500 p-2 rounded-r text-white hover:bg-red-600"
                        wire:click="delete({{$note_list->id}})">Delete
                </button>
            </div>
        </div>
    @endforeach
    {{ $notes->links('vendor.livewire.tailwind') }}


    @if($status)
    <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                  Background overlay, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                      aria-hidden="true">&#8203;</span>
                <!--
                  Modal panel, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                                <!-- Heroicon name: exclamation -->
                                <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    Update Note
                                </h3>
                                <div class="mt-2">
                                    <label>
                                        <input wire:model="input_update" type="text"
                                               id="input_update" placeholder="Note"
                                               class="border-2 rounded p-1 mb-1 mt-1 w-full">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="update({{$identify}})" type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Update
                        </button>
                        <button wire:click="modal_close" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
