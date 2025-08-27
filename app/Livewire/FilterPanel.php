<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class FilterPanel extends Component
{
    /**
     * A structured array to hold tags grouped by their category.
     *
     * @var array
     */
    public $tagCategories = [];

    /**
     * The mount method is called only once when the component is initialized.
     * We use it to fetch and structure our data.
     */
    public function mount()
    {
        // Fetch all tags and group them by the 'category' column.
        // The result is a collection of collections, which we convert to an array.
        $this->tagCategories = Tag::all()->groupBy('category')->toArray();
    }

    /**
     * The render method returns the component's view.
     */
    public function render()
    {
        return view('livewire.filter-panel');
    }
}
