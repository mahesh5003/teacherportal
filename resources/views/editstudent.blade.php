<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Edit Students Details') }}
</h2>
</x-slot>

@if (session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
@endif

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-md-6">
<div class="p-6 text-gray-900 ">

<form method="post" action="{{ route('student.update') }}">
@csrf
<input type="hidden" name="id" value="{{$student->id}}">
<div class="mb-3 ">
<label for="name" class="form-label">Name</label>
<input type="text" name="name" class="form-control" id="name" value="{{old('name',$student->name)}}">
<div class="errormessage"> @error('name') {{ $message }} @enderror</div>
</div>

<div class="mb-3 ">
<label for="subject" class="form-label">Subject</label>
<input type="text" name="subject" class="form-control" id="subject" value="{{old('subject',$student->subject)}}" >
<div class="errormessage"> @error('subject') {{ $message }} @enderror</div>
</div>

<div class="mb-3 ">
<label for="marks" class="form-label">Marks</label>
<input type="number" name="marks" class="form-control" id="marks" value="{{old('marks',$student->marks)}}">
<div class="errormessage"> @error('marks') {{ $message }} @enderror</div>
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>


</x-app-layout>





