@extends('layouts.app')
@section('content')
<div class="flex flex-col p-4 w-full h-full overflow-y-auto">

    <h1 class="text-2xl font-bold mb-4">Task Run {{ $taskRun->id }} Output</h1>
    
    <h2 class="text-xl font-bold mt-4">Output</h2>
    <pre class="w-full mt-4 border border-[#E2E8F0] rounded-lg overflow-hidden shadow-md p-4 bg-gray-100 text-gray-800 whitespace-pre-wrap break-words">
        {{ $output }}
    </pre>
</div>
@endsection