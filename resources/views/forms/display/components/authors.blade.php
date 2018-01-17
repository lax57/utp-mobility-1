<div class="form-group d-block bg-light rounded p-2 mx-0 mb-3">
    <label>{{$title}}</label>
    @foreach($authors as $author)
    <div class="row p-2 mx-0">
        <input class="form-control col-2 mr-2" value="{{$author->author_cedula}}" readonly />
        <input class="form-control col-4 mr-2" value="Authors name" readonly />
        <input class="form-control col-4 mr-2" value="Authors organisational unit" readonly />
    </div>
    @endforeach
</div>