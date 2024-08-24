<?php

namespace App\Livewire;
use Livewire\Component;

// Internal Values

class Todos extends Component {
    // Props

    public $loading = false;
    public $todos;
    public $showDebug = false;
    public $debug = [];
    public $title = '';

    // Computed
    

    // Actions
    public function add() {
      $this->title = trim($this->title);


      if ($this->title != '') {
        $this->loading = true;
        // Add the Todo
        $encodedTitle = urlencode($this->title);
        $addTodo = useAPI('GET', 'https://jonknoll.dev/wp-json/todo/v1/add/?title='.$encodedTitle.'&now='.time());
        $addTodo = json_decode($addTodo);
        
        
        if ($this->showDebug) {
          $this->debug['title'] = $this->title;
          $this->debug['todos'] = $this->todos;
          $this->debug['addTodo'] = $addTodo;
        }
        
        // Add the Todo to the List
        array_unshift($this->todos, $addTodo);
      };



      $this->title = '';
      $this->loading = false;
    }
    public function remove($id) {
      $this->loading = true;
      // Remove the Todo
      $removeTodo = useAPI('GET', 'https://jonknoll.dev/wp-json/todo/v1/remove/?id='.$id.'&now='.time());
      $removeTodo = json_decode($removeTodo);
      
      // Find the Todo and Remove it
      foreach ($this->todos as $key => $todo) {
        if ($todo->id == $id) {
          unset($this->todos[$key]);
        }
      }

      
      if ($this->showDebug) {
        $this->debug['id'] = $id;
        $this->debug['removeTodo'] = $removeTodo;
        $this->debug['todos'] = $this->todos;
      }

      $this->loading = false;
    }
    public function update($id, $done) {
      // Update the Todo
      $done = $done ? 'true' : 'false';
      $updateTodo = useAPI('GET', 'https://jonknoll.dev/wp-json/todo/v1/update/?id='.$id.'&done='.$done.'&now='.time());
      $updateTodo = json_decode($updateTodo);
      
      // Find the Todo and Update it
      foreach ($this->todos as $key => $todo) {
        if ($todo->id == $id) {
          $this->todos[$key]->done = $done;
        }
      }
        
      if ($this->showDebug) {
        $this->debug['id'] = $id;
        $this->debug['done'] = $done;
        $this->debug['updateTodo'] = $updateTodo;
        $this->debug['todos'] = $this->todos;
      }
      
      $this->loading = false;
    }
    
    
    // Lifecycle
    public function render() {
      // Set initial Todos
      $getTodos = useAPI('GET', 'https://jonknoll.dev/wp-json/todo/v1/todos?now='.time());
      $getTodos = json_decode($getTodos);

      if ($this->showDebug) {
        $this->debug['getTodos'] = $getTodos;
        $this->debug['now'] = time();
      }

      if (isset($getTodos->todos)) $this->todos = $getTodos->todos;

      return view('livewire/todos');
    }
}
