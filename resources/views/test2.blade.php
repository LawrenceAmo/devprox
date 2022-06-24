
@extends('inc.layout')

@section('content')
<div class="mb-5 pb-5 " id="app">
    <div class="h3 font-weight-bold mt-3 d-flex justify-content-center">
        Test 2
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
       {{--  --}}
        <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data"  class="shadow rounded border border-danger p-3"  >
            @csrf
             <div class="h5 text-center font-weight-bold">  Upload File to Database</div>
            <div class=" w-100">
                 <label  class="w-100" > choose a file, and click upload</label>
                    <div class="md-form md-bg mt-0  ">
                        <input type="file" v-model="record_number"  name="file"    required class="form-control   "   placeholder="Enter Number of records to generate">
                       
                    </div>
              </div> 
    
              {{-- form buttons --}}
               <div class="row  w-100 mx-0   pr-2">
                  <div class="col-md-12 p-2">
                    <button type="submit" class="btn btn-sm rounded w-100 btn-danger font-weight-bold"   >Save to Database</button>
                 </div>
                 
                </div> 
 
            </form>
    </section>
    {{-- form section end --}}
  <section class=" col-md-4  p-3  ">
       {{--  --}}
        <form action="{{ route('export_csv') }}" method="POST"   class="shadow rounded border border-primary p-3"  >
            @csrf
             <div class="h5 text-center font-weight-bold">Save Users to CSV File</div>
            <div class=" w-100">
                 <label  class="w-100 small" > Number of Users you want to generate. this may take longer for large files</label>
                    <div class="md-form md-bg mt-0  ">
                        <input type="number"    name="number" min="0"   required class="form-control   "   placeholder="Enter Number of records to generate">
                       
                    </div>
              </div> 
    
              {{-- form buttons --}}
               <div class="row  w-100 mx-0   pr-2">
                  <div class="col-md-12 p-2">
                    <button type="submit" class="btn btn-sm rounded w-100 btn-primary font-weight-bold"   >Save to csv file</button>
                 </div>
                 
                </div> 
 
            </form>
    </section>
      <section class=" col-md-4  p-3  ">
       {{--  --}}
        <div    class="shadow rounded border border-secondary p-3"  >
            
             <div class="h5 text-center font-weight-bold">Curent Records in Database</div>
            <div class=" w-100">
                <label  class="w-100 small" > These Records will be updated every 5-10 seconds, until all data is inserted into database</label>

                 <div  class="w-100 row border rounded pt-1 pb-0" >
                    <p class="col-7 border-right">Curent Users in DB</p>
                 <p class="col-5 font-weight-bold" id="record_from_db">0</p>
                </div>
                    
              </div> 
    
              {{-- form buttons --}}
               <form action="{{ route('destroy') }}" method="GET" class="row  w-100 mx-0   pr-2">
                  <div class="col-md-12 p-2">
                    <button   type="submit" class="btn btn-sm rounded w-100 btn-secondary font-weight-bold"   >delete all current records</button>
                 </div>
                 
                </form> 
 
 
            </div>
    </section>
   
</main>

<section class="row    border rounded p-3 mx-md-5 d-none">

    <form action="" class="card  border w-100 border-success">
       <div class="card-body row">
       <div class="col-md-8">
         <h4 class="card-title h3 font-weight-bold">Upload a CSV File, and Save records into Databese</h4>
        <p class="card-text"><button class="btn btn-sm rounded w-75 btn-outline-info font-weight-bold">select or browse file</button></p>
       </div>
       <div class="col-md-4 py-auto  d-flex flex-column   justify-content-center">
        {{-- <p class=""></p> --}}
        <p class=""><button type="submit" class="btn btn-lg rounded w-100 btn-info font-weight-bold  ">Upload File and save    </button></p>
       </div>
      </div>
    </form>

</section>

 
    </section>
</div>


</div>

 <script> 

//  send api request to users db to update this view
setInterval( async () => {
     
    await axios.get('http://127.0.0.1:8000/api/test2/get_curent_records/').then(async function (response) {
                          document.getElementById("record_from_db").innerHTML  = response.data;
                          console.log( response.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
            }, 3000);

 
</script>
@endsection
