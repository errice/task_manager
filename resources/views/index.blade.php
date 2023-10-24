@extends('layouts.app')
 
<h1>
    @section('title' ,'List of items' )
</h1>

@section('content')
   
   <nav class="mb-4">
    <a href="{{ route('tasks.create') }}" class="font-medium text-red-700 underline decoration-pink-500">Add Task!</a>
  </nav>
<?php  $i=1; //playing with raw php?>
@if (count($tasks))
    @foreach ($tasks as $task)
        <div>
        <span class="font-bold">
        <?php echo $i; //echo counter number ?>.  
        </span>
  
     <a href="{{ route('tasks.show',['task' => $task->id]) }}" @class(['text-gray-600','line-through' => $task -> completed])>
     {{-- Adding a tailwind class condition to make text strick through when task is completed--}}
     {{ $task-> title }} 
     </a>
        </div> 
<?php $i= $i+1;?>
    @endforeach
  
  @else
    <div>There are no tasks!</div>
 @endif

@if($tasks->count())
    <nav>
        {{ $tasks->links() }}
    </nav>
@endif
@endsection
