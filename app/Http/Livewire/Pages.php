<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use Illuminate\Validation\Rule;

class Pages extends Component
{
    public $modalFormVisible = false, $slug, $title, $content, $modelId;
        
    public function rules(){
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')],
            'content' => 'required'
        ];
    }
    
    /**
     * Runs every time the title is rendered/updated.
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedTitle($value){
        $this->genetateSlug($value);
    }

    /**
     * The create function.
     *
     * @return void
     */
    public function create(){
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }
    
    /**
     * The read function.
     *
     * @return void
     */
    public function read(){
        $pages = Page::all();
        return $pages;
    }

    public function update(){
        $this->validate();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * Shows the form modal
     * of the create function.
     *
     * @return void
     */
    public function createShowModal(){
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }
    
    /**
     * Shows the form modal
     * in update mode.
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id){
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModal();
    }
    
    /**
     * Loads the modal data
     * of this component.
     *
     * @return void
     */
    public function loadModal(){
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;

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
        $this->slug = $this->title = $this->content = $this->modelId = null;
    }
    
    /**
     * Genetaes a url slug 
     * based on the title.
     *
     * @param  mixed $value
     * @return void
     */
    private function genetateSlug($value){
        $process1 = str_replace(' ', '-', strtolower($value));
        $this->slug = $process1;
    }
    
    /**
     * The livewire render function.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }
}
