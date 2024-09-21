<x-app-layout>


<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Students Details') }}
</h2>
</x-slot>

@if (session('status'))
<div class="alert alert-success" id="status">
{{ session('status') }}
</div>
@endif

@if (session('delete'))
<div class="alert alert-danger" id="delete">
{{ session('delete') }}
</div>
@endif

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
<table class="table">
<thead>
<tr>
<th scope="col">Name</th>
<th scope="col">Subject</th>
<th scope="col">Marks</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
@if(count($students)<=0)
<tr>
<tr>
<td class="text-center" colspan="4">No data found.</td>
</tr>
</tr>
@else
@foreach ($students as $student)
<tr>
<td>
<input type="text" value="{{$student->name}}" class="name{{$student->id}}" sid="{{$student->id}}" disabled>  
</td>
<td>
<input type="text" value="{{$student->subject}}" class="subject{{$student->id}}" sid="{{$student->id}}" disabled>  
</td>
<td>
<input type="number" value="{{$student->marks}}" class="marks{{$student->id}}" sid="{{$student->id}}" disabled>  
</td>
<td>


<button type="button" class="btn btn-primary inlineedit" sid="{{$student->id}}" id="eedit{{$student->id}}" data-url="{{ route('student.editenline')}}">
<span  >InlineEdit</span>  </button>

<button type="button" class="inlineupdate btn btn-primary d-none" sid="{{$student->id}}" id='eupdate{{$student->id}}' data-url="{{ route('student.editenline')}}"> <span class="">Update</span> </button>



<a class="text-decoration-none" href="{{ route('student.edit', ['id' => $student->id]) }}" class="btn btn-primary reset-btn">
<button type="button" class="btn btn-primary">Edit</button>
</a>
<a class="text-decoration-none" href="{{ route('student.destroy', ['id' => $student->id]) }}" class="btn btn-primary reset-btn">
<button type="button" class="btn btn-danger">
Delete</button>
</a>
</td>
</tr>
@endforeach
@endif
</tbody>
</table>

<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Add</button>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="staticBackdropLabel">Add Student</h5>
</div>
<div class="modal-body">

<div class="mb-3">
<label for="name" class="form-label">Name</label>
<input type="text" class="form-control" id="name" >
</div>

<div class="mb-3">
<label for="subject" class="form-label">Subject</label>
<input type="text" class="form-control" id="subject" >
</div>

<div class="mb-3">
<label for="marks" class="form-label">Marks</label>
<input type="number" maxlength="3" class="form-control" id="marks">
</div>

</div>
<div class="modal-footer">
<button type="button" id="closestudent" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" id="addstudent" data-url="{{ route('student.add') }}" class="btn btn-primary">Add</button>
</div>
</div>
</div>
</div>

</div>
</div>
</div>

<script>

setTimeout(function() {
$('#status').remove();
}, 2000); 

setTimeout(function() {
$('#delete').remove();
}, 2000); 


//update enline fields
$(document).ready(function(){
$(document).on("click", ".inlineupdate", function(e) {

let sid=$(this).attr('sid');
let name=$('.name'+sid).val();
let subject=$('.subject'+sid).val();
let marks=$('.marks'+sid).val();

if(name!=="" && marks!=="" && subject!==""){

let url=$(this).attr("data-url");
$.ajax({
url:url,
type:'POST',
data:{'id':sid,'marks':marks,'subject':subject,'name':name,_token:'{{csrf_token()}}'},
success:function(data){
if(data==0){
alert("With the same Student name and marks entry alredy available please user other student name and marks to update studenr details");
$('#eedit'+sid).removeClass('d-none');
$('.name'+sid).removeClass("inline-edit-style");
$('.subject'+sid).removeClass("inline-edit-style");
$('.marks'+sid).removeClass("inline-edit-style");
$('#eedit'+sid).removeClass('d-none');
$('#eupdate'+sid).addClass('d-none');

$('.name'+sid).attr("disabled");
$('.subject'+sid).attr("disabled");
$('.marks'+sid).attr("disabled");

location.reload();

}else{
alert("Stuent details updated successfully");     
location.reload();
}

}
});

}else{
alert("All details of student are compulsary");
}


});
});


//make updateble inline fields.
$(document).ready(function(){
$(document).on("click", ".inlineedit", function(e) {
let sid=$(this).attr('sid');
$('.name'+sid).removeAttr("disabled");
$('.subject'+sid).removeAttr("disabled");
$('.marks'+sid).removeAttr("disabled");

$('.name'+sid).addClass("inline-edit-style");
$('.subject'+sid).addClass("inline-edit-style");
$('.marks'+sid).addClass("inline-edit-style");
$('#eedit'+sid).addClass('d-none');
$('#eupdate'+sid).removeClass('d-none');
});
});

//After student add empty input boxes
$(document).ready(function(){
$(document).on("click", "#closestudent", function(e) {
$("#name").val("");
$("#subject").val("");
$("#marks").val("");
});
});

$(document).ready(function(){
$(document).on("click", "#addstudent", function(e) {

let name=$("#name").val();
let subject=$("#subject").val();
let marks=$("#marks").val();

if(name!=="" && marks!=="" && subject!==""){

let url=$(this).attr("data-url");
$.ajax({
url:url,
type:'POST',
data:{'marks':marks,'subject':subject,'name':name,_token:'{{csrf_token()}}'},
success:function(data){
$("#name").val("");
$("#subject").val("");
$("#marks").val("");
alert("Student added successfully");
location.reload();
}
});

}else{
alert("All details of student are compulsary");
}
});
});
</script>

</x-app-layout>


