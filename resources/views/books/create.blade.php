@extends('layouts.app')

 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-12">
           <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>

               <li class="breadcrumb-item active" aria-current="page">Add Book</li>
           </ol>
           </nav>
           <div class="card">
             <div class="card-header">
               Add Books
             </div>

             <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="input-tab" data-toggle="tab" href="#input" role="tab" aria-controls="input" aria-selected="true">Input</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="false">Upload</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="input" role="tabpanel" aria-labelledby="input-tab">
                            @include('books._form')
                        </div>
                        <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                            <form action=" {{ route('import.books.excel') }} " method="post" enctype="multipart/form-data">
                                @csrf
                                @include('books._import')
                            </form>
                        </div>
                    </div>
                </div>

         </div>
     </div>
   </div>
</div>
 @endsection
