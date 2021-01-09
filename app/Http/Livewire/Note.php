<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Validator;

class Note extends Component
{
    use WithPagination;
    public $note;
    public $search;
    public $input_update;
    public $status;
    public $identify;

    public function render()
    {
        return view('livewire.note',[
            'notes' =>\App\Models\Note::where('note', 'LIKE', '%'.$this->search.'%')->orderBy('id', 'DESC')->paginate(4),
        ]);
    }

    public function create()
    {
        Validator::make(['note'=>$this->note], [
            'note' => 'required|min:3|max:220'
        ])->validate();

        $note_obj = new \App\Models\Note();
        $note_obj->note = $this->note;
        $note_obj->save();
        $this->note = '';
    }

    public function delete($value)
    {
        $excluded_note = \App\Models\Note::where('id', '=', $value)->first();
        if($excluded_note){
            $excluded_note->delete();
        }
    }

    public function update($id)
    {
        $obj_note = \App\Models\Note::where('id', '=', $id)->first();
        $obj_note->note = $this->input_update;
        $obj_note->save();
        $this->modal_close();
    }

    public function modal_open($data)
    {
        $this->identify = $data['id'];
        $this->input_update = $data['note'];
        $this->status = true;
    }

    public function modal_close()
    {
        $this->status = false;
    }

}
