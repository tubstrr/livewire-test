<section class="page">
    <h1>Basic todo - Livewire</h1>

    @if ($debug)
        <pre>{{ var_dump($debug) }}</pre>
    @endif

    <div class="container" x-data="{ loading: $wire.entangle('loading') }">
        <div x-show="loading" class="loading">Loading...</div>
        <ul>
            @foreach ($todos as $todo)
                <li>
                    <button class="done"
                        @click="loading = true; $wire.update({{ $todo->id }}, {{ $todo->done ? 'false' : 'true' }})"
                        {{-- x-on:click="$wire.update({{ $todo->id }}, {{ $todo->done ? 'false' : 'true' }})" --}}>
                        @if ($todo->done)
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path
                                    d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z">
                                </path>
                            </svg>
                        @endif
                    </button>
                    {{ $todo->title }}

                    <button class="remove" @click="loading = true; $wire.remove({{ $todo->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <path
                                d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z">
                            </path>
                        </svg>
                    </button>
                </li>
            @endforeach
        </ul>
        {{-- Nuxt3 <form @submit.prevent="addTodos">
          <div>
            <label for="addNew">Add New Item:</label>
            <input type="text" v-model="newTodo" id="addNew" />
          </div>
          <button>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              height="1em"
              viewBox="0 0 448 512"
            >
              <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
              <path
                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"
              />
            </svg>
            Add
          </button>
        </form> --}}

        <form @submit="loading = true;" wire:submit="add">
            <div>
                <label for="addNew">Add New Item:</label>
                <input type="text" wire:model="title" id="addNew" />
            </div>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
                Add
            </button>
        </form>
    </div>
</section>
{{-- <div>
    <h1>Counter!</h1>
    <h1>{{ $count }}</h1>
    <ul>
        @foreach ($methods as $method)
            <li>
                <button x-on:click="$wire.update('{{ $method }}')">{{ $method }}</button>
            </li>
        @endforeach
    </ul>
</div> --}}
