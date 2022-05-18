<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'sort',
    ];

    public $perPage = 10;
    public $sortDirection;
    public $sort;
    public $page = 1;

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::with('account')
                ->when($this->sort, function ($query) {
                    if ($this->sort === 'order') {
                        $query->join('accounts', 'users.id', '=', 'accounts.user_id')
                            ->orderBy('accounts.order', $this->sortDirection ? 'asc' : 'desc');
                    } else {
                        $query->orderBy($this->sort, $this->sortDirection ? 'asc' : 'desc');
                    }
                    return $query;
                })->orderByDesc('users.id')
                ->paginate($this->perPage)
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sort === $field) {
            $this->sortDirection = !$this->sortDirection;
        } else {
            $this->sortDirection = true;
        }

        $this->sort = $field;
    }
}
