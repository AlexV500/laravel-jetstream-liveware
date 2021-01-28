<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class ExpenseEdit extends Component
{
    use WithFileUploads;

    public Expense $expense;

    public $amount;
    public $description;
    public $type;
    public $photo;

    protected $rules = [
        'amount' => 'required',
        'type' => 'required',
        'description' => 'required',
        'photo' => 'image|nullable',
    ];

    public function mount()
    {
        $this->description = $this->expense->description;
        $this->amount = $this->expense->amount;
        $this->type = $this->expense->type;
    }

    public function render()
    {
        return view('livewire.expense.expense-edit');
    }

    public function updateExpense()
    {
        $this->validate();

        if ($this->photo) {
            if (Storage::disk('public')->exists($this->expense->photo))
                Storage::disk('public')->delete($this->expense->photo);

            $this->photo = $this->photo->store('expenses-photos', 'public');
        }

        $this->expense->update([
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description,
            'photo' => $this->photo ?? $this->expense->photo,
        ]);

        session()->flash('message', 'Registro atualizado com sucesso!');
    }
}
