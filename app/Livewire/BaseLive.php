<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseLive extends Component
{
	use WithPagination;

	public $deleteId;
    public $updateId;
    public $reset = false;
    public $searchTerm;
    public $mode = 'create';

    public $perPage = 10;

    public function paginationView()
    {
        return 'livewire.common.pagination._pagination';
    }

    public function resetInputFields() {
        $this->reset();
    }

    public function setDeleteId($id) {
        $this->deleteId=$id;
    }
}

