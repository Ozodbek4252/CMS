<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use Illuminate\Validation\Rule;

class Pages extends Component
{
    public $modalFormVisible = false, $slug, $title, $content;
        
    public function rules(){
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')],
            'content' => 'required'
        ];
    }

    /**
     * The create function.
     *
     * @return void
     */
    public function create(){
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    /**
     * Shows the form modal
     * of the create function.
     *
     * @return void
     */
    public function createShowModal(){
        $this->modalFormVisible = true;
    }
    
    /**
     * The data for the model mapped 
     * in this component.
     *
     * @return void
     */
    public function modelData(){
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content
        ];
    }
    
    /**
     * Resets all the variables 
     * to null.
     *
     * @return void
     */
    public function resetVars(){
        $this->slug = $this->title = $this->content = null;
    }
    
    /**
     * The livewire render function.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages');
    }
}
