<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseLive extends Component
{
	use WithPagination;

	public $deleteId;
    public $reset = false;
    public $searchTerm;
    public $mode = 'create';

    public $perPage = 10;

    public function paginationView()
    {
        return 'livewire.common.pagination._pagination';
    }

    public function setDeleteId($id) {
        $this->deleteId=$id;
    }
    // public function levelClicked(){

    // }
    // public function resetSearch(){
    //     $this->reset = true;

    // }
    // public function updatingSearchTerm() {
    //     $this->resetPage();
    // }
    // public function updatingSearchCategory() {
    //     $this->resetPage();
    // }
    // public function updatingStore(){
    //     dd($this->checkEditPermission);
    // }
    // public function updatingSetDate() {
    //     $this->resetPage();
    // }
    // public function updatingPerPage() {
    //     $this->resetPage();
    // }
}

