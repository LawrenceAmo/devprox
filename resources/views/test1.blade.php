
@extends('inc.layout')

@section('content')
<div class="">
    <div class="h3 font-weight-bold mt-3 d-flex justify-content-center">
        Test 1
    </div>
    {{-- Alert message display --}}
     <div class="row mt-3 mx-0     rounded pt-3 w-100 animated fadeIn  ">
            <div class="col-12 text-center">
                <h5 class="animated pulse w-100 ">@include('inc.messages')</h5>
            </div>
         </div>
<main class="row    border rounded px-3 pb-3 mx-md-5">
    {{-- Form  --}} {{--  name, Surname, Id No, Date of Birth, POST button, CANCEL button --}}
    <section class=" col-md-4  p-3  ">
       
        <form  action="{{ route('create_user') }}" class="shadow rounded border p-3" method="POST">
            @csrf
            <div class="h5 text-center font-weight-bold">Create User</div>
            <div class=" w-100">
                 <label  class="w-100" > Name</label>
                    <div class="md-form md-bg mt-0  ">
                        <input type="text"   name="name" id="name" value="{{ old('name',$data["name"])}}" required class="form-control @error('name') is-invalid @enderror "   placeholder="Enter Name">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
              </div> 

                 <div class=" w-100">
                 <label  class="w-100" > Surname</label>
                    <div class="md-form md-bg mt-0  ">
                        <input required type="text" name="surname" id="surname" class="form-control   @error('surname') is-invalid @enderror" value="{{  old('surname',$data["surname"])}}"  placeholder="Enter Surname">
                         @error('surname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                     </div>
              </div> 

              <div class=" w-100 pb-3">
                 <label  class="w-100" > Date Of Birth</label>
                    <div class="  mt-0  ">
                        <input required type="date" name="date_of_birth" id="date_of_birth" class="form-control  @error('date_of_birth') is-invalid @enderror " max="3000-01-01" onfocus="this.max=new Date().toISOString().split('T')[0]"  value="{{  old('date_of_birth',$data["date_of_birth"])}}"  placeholder="Enter Date of Birth">
                         @error('date_of_birth')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
 
              </div>
                 <div class=" w-100">
                 <label  class="w-100" > ID Number</label>
                    <a class="md-form md-bg mt-0  ">
                        <input required type="number" name="id_number" id="id_number" class="form-control  @error('id_number') is-invalid @enderror " min="0" value="{{  old('id_number',$data["id_number"])}}"  placeholder="Enter ID Number">
                         @error('id_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </a>
              </div> 
              {{-- form buttons --}}
               <div class="row  w-100 mx-0   pr-2">
                  <div class="col-md-6 p-2">
                    <a class="btn btn-sm rounded w-100 btn-warning" onclick="clear_form();" >CANCEL form</a>
                 </div>
                  <div class="col-md-6 p-2">
                    <button class="btn btn-sm rounded w-100 btn-primary" type="submit">Save User</button>
                 </div>                   
                </div> 
 
        </form>
    </section>
    {{-- form section end --}}

    {{-- table colunm  --}}
    <section class="col-md-8  p-3">
        <div class="shadow rounded border p-3" >
                        <div class="h5 text-center font-weight-bold">All Users</div>

       <table class="table table-striped w-100 table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr> 
                <th>#</th>
                <th>Name</th>
                <th>Surname</th>
                <th>ID Number</th>
                <th>Date of Birth</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )
                <tr>
                    <td scope="row">{{ $loop->index+1 }}</td>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->surname}}</td>
                    <td>{{ $user->id_number}}</td>
                    <td>{{ $user->date_of_birth}}</td>
                    <td> 
                        {{-- delete user with ID --}}
                        <form  action="{{ route('delete_user') }}" method="post">
                            @csrf
                        <input type="hidden" name="userID" value="{{$user->id}}">
                        <button type="submit" class="text-danger border-0 bg-transparent"><i class="fas fa-trash-alt    "></i></button>
                        </form>
                    </td>
                </tr>
               @endforeach

            </tbody>
       </table>
       @if (count($users) <=0)
             <div class="h5 text-center font-weight-bold text-muted"> <i class="fas fa-frown    "></i> &nbsp; No Data Yet!</div>
       @endif
       {{-- Pagination --}}
       <div class="text-center rounded p-2">{{ $users->onEachSide(5)->links() }}</div>
        </div>
    </section>
    {{-- table section end --}}
</main>
</div>
<script>
    // Clear Form data
    function clear_form() {
        document.getElementById("name").value = "";
        document.getElementById("surname").value = "";
        document.getElementById("date_of_birth").value = "";
        document.getElementById("id_number").value = "";
    }
</script>
@endsection
