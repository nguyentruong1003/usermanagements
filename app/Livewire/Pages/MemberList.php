<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseLive;
use App\Models\Member;
use Livewire\WithFileUploads;

class MemberList extends BaseLive
{
    use WithFileUploads;

    public $name, $email, $phone, $birthday, $sex, $hobby, $level, $address, $note;
    public $image;
    public $remove_path;
    public $remove;
    public $change_image = false;
    public $tmpUrl;
    protected $listeners = [
        'remove_path' => 'removePath',
    ];

    public function render()
    {
        $query = Member::query();
        
        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }
        $data = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.pages.member-list', ['data' => $data]);
    }

    public function delete()
    {
       Member::findOrFail($this->deleteId)->delete();
       $this->dispatch('show-toast', ["type" => "success", "message" => __('notification.common.success.delete')] );
       
    }
    public function edit($id)
    {
        $this->mode = 'edit';
        $this->updateId = $id;
        $editMember = Member::findOrFail($id);
        $this->name = $editMember->name;
        $this->email = $editMember->email;
        $this->phone = $editMember->phone;
        $this->sex = $editMember->sex;
        $this->birthday = $editMember->birthday;
        $this->level = $editMember->level;
        $this->hobby = $editMember->hobby;
        $this->address = $editMember->address;
        $this->note = $editMember->note;
        $this->image = $editMember->image;
        $this->tmpUrl = $this->image ? 'storage/' . substr($this->image, 7) : null;
    }

    public function saveData()
    {
        // $this->validate([
        //  ]);
        if (!isset($this->updateId)) {
            $member = Member::create([
                'name' => $this->name,
                'sex' => $this->sex,
                'birthday' => $this->birthday,
                'email' => $this->email,
                'phone' => $this->phone,
                'level' => $this->level,
                'hobby' => $this->hobby,
                'address' => $this->address,
                'note' => $this->note,
            ]);
        } else {
            $member = Member::findOrFail($this->updateId);
            $member->name = $this->name;
            $member->sex = $this->sex;
            $member->birthday = $this->birthday;
            $member->email = $this->email;
            $member->phone = $this->phone;
            $member->level = $this->level;
            $member->hobby = $this->hobby;
            $member->address = $this->address;
            $member->note = $this->note;
        }
        if(isset($this->remove_path) && $this->remove_path){
            if(file_exists('./storage/'. $member->image)){
                unlink('./storage/'. $member->image);
            }
            $member->image = null;
        }
        if (($this->change_image || $this->mode == 'create') && $this->image) {
            $member->image = $this->image->storeAs('public/photos', $this->image->getClientOriginalName());
        }
        $member->save();
        $this->reset();
        $this->dispatch('close-modal');
        $this->dispatch('show-toast', ["type" => "success", "message" => __('notification.common.success.update')] );
    }

    public function removePath() {
        $this->remove_path = $this->image;
        $this->image = null;
        $this->change_image = true;
    }

    public function updatedImage() {
        $this->tmpUrl = null;
        $this->change_image = true;
    }
}
