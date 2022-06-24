
@extends('inc.layout')

@section('content')
<div class="" id="app">
    <div class="h3 font-weight-bold mt-3 d-flex justify-content-center">
        Test 1
    </div>
    {{-- Alert message display --}}
     <div class="row mt-3 mx-0     rounded pt-3 w-100 animated fadeIn  ">
            <div class="col-12 text-center">
                <h5 class="animated pulse w-100 ">@{{msg}}</h5>
            </div>
         </div>
<main class="row    border rounded px-3 pb-3 mx-md-5">
    {{-- Form  --}} {{--  name, Surname, Id No, Date of Birth, POST button, CANCEL button --}}
    <section class=" col-md-4  p-3  ">
       {{--  --}}
        <div    class="shadow rounded border p-3"  >
             <div class="h5 text-center font-weight-bold">Create User</div>
            <div class=" w-100">
                 <label  class="w-100" > Number of Users you want to generate</label>
                    <div class="md-form md-bg mt-0  ">
                        <input type="number" v-model="record_number"  name="number" min="0"   required class="form-control   "   placeholder="Number of records to generate">
                       
                    </div>
              </div> 
    
              {{-- form buttons --}}
               <div class="row  w-100 mx-0   pr-2">
                  <div class="col-md-12 p-2">
                    <a class="btn btn-sm rounded w-100 btn-primary" @click="generate_names();" >generate users</a>
                 </div>
                 
                </div> 
 
            </div>
    </section>
    {{-- form section end --}}

    {{-- table colunm  --}}
    <section class="col-md-8  p-3">
        <div class="shadow rounded border p-3" >
                        <div class="h5 text-center font-weight-bold">All Users</div>
                        <div class="row w-100">
                            <div class="col-md-4">
                                <div class="border rounded p-2 border-info">
                                    <p class="">Total Records: <span class="font-weight-bold"> @{{total_records}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-2 border-info">
                                    <p class="">Generated Records: <span class="font-weight-bold"> @{{generated_records}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-2 border-info">
                                    <p class="">Remaining Records: <span class="font-weight-bold"> @{{remaining_records}}</span></p>
                                </div>
                            </div>
                        </div>
                        <hr>
{{-- /////////////////////////////////////////////////////// --}}
                         <div class="row w-100 mt-3">
                            <div class="col-md-4">
                                <div class="border rounded p-2 border-info">
                                    <p class="">Total Unique Users: <span class="font-weight-bold"> @{{unique}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-2 border-info">
                                    <p class="">Duplicated Users: <span class="font-weight-bold"> @{{duplicated}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-2 border-danger">
                                    <p class="font-weight-bold">All Generated Records in Total: <span class="font-weight-bold h4"> @{{requested_records}}</span></p>
                                </div>
                            </div>
                        </div>
{{-- //////////////////////////////////////////////// --}}
                           <div class="row w-100 mt-3 pt-3">
                            <div class="col-md-4">
                                <div class="  rounded   ">
                                     <div class="">
                                    <a class="btn btn-sm rounded w-100 btn-info px-1"  @click="filter_records();" >filter duplicated records</a>
                                </div>                   
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="  rounded   ">
                                     <div class="">
                                    <a class="btn btn-sm rounded w-100 btn-info px-1"  @click="re_generate_records();" >Auto Balance records</a>
                                </div>                   
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="  rounded   ">
                                     <div class="">
                                    <a class="btn btn-sm rounded w-100 btn-danger px-1 font-weight-bold"  @click="save_users_records();" >save all records to Database</a>
                                </div>                   
                            </div>
                            </div>
                        </div>

 
        </div>
    </section>
    {{-- table section end --}}
</main>

<div class="row px-5 py-3 w-100 ">
       <section class="col-md-12  p-3">
        <div class="shadow rounded border   p-3" >
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
                {{-- @foreach ($users as $user )
                <tr>
                    <td scope="row">{{ $loop->index+1 }}</td>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->surname}}</td>
                    <td>{{ $user->id_number}}</td>
                    <td>{{ $user->date_of_birth}}</td>
                    <td> 
                        {{-- delete user with ID --}}
                        {{-- <form  action="{{ route('delete_user') }}" method="post">
                            @csrf
                        <input type="hidden" name="userID" value="{{$user->id}}">
                        <button type="submit" class="text-danger border-0 bg-transparent"><i class="fas fa-trash-alt    "></i></button>
                        </form>
                    </td>
                </tr>
               @endforeach --}}  

            </tbody>
       </table>
       {{-- @if (count($users) <=0)
             <div class="h5 text-center font-weight-bold text-muted"> <i class="fas fa-frown    "></i> &nbsp; No Data Yet!</div>
       @endif --}}
       {{-- Pagination --}}
       {{-- <div class="text-center rounded p-2">{{ $users->onEachSide(5)->links() }}</div> --}}
        </div>
    </section>
</div>


</div>

 <script> 
      const { createApp } = Vue;
      //  let
      createApp({
        data() {
          return {
            // 
            msg: "",                    // Show message 
            // 
            total_requested_records: 0,  // number of records user want to generate it is fixed
            // 
            user_records: [],           // all user records in general
            record_number: "",          // (it records the difference between generated users and remaining users )
            total_records: 0,           // all records to be generated
            generated_records: 0,       // current generated records
            remaining_records: 0,       // current remaining records
            // 
            duplicated: 0,
            unique:0,
             unique_uid: [],
            total_unique_uid: [],

            // 
            total_unique_users: [],
          };
        },
        computed: {
                // a computed getter
                requested_records() {
                return this.total_requested_records += this.total_records;
                }
            },        
        methods: {
           alert_msg: function (msg) {
            //  this.msg = "";
             this.msg = msg;
            // setTimeout(() => {
            //    this.msg = "";
            // }, 10000);
          }, 
           generate_names: async function() 
            {
                if (!Number.isInteger(this.record_number)) {
                    this.record_number = 0;
                     this.alert_msg("Please insert a number")
                    return false;
                }
                let user_records = this.user_records = [];
                this.record_number = parseInt(this.record_number)
                // 
                console.log(this.record_number)
                 this.total_records =this.record_number;
                 this.generated_records = 0;
                 let max_limit = 100000;                  // limit number of users to be generated per request (NB: bigger number can cause 500 server error)
                 let loop_value = 0;
                 let loop =true

               while (loop) {

               if (this.record_number > max_limit) {
                    this.record_number = await this.record_number - max_limit;
                    loop_value = await max_limit;
                  }else{
                    loop_value = await this.record_number;
                    loop = await false; 
                    this.record_number = await 0; 
                }
 
               const request = await axios.post('http://127.0.0.1:8000/api/test2/random_user_info/',{
                        number: loop_value,
                 }).then(async function (response) {
                                if ( user_records.length < 1) {
                                    user_records.push(response.data);
                                }else{
                                    user_records[0].push(response.data);
                                }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    this.user_records = await user_records;
                    this.generated_records += await loop_value;
                    this.remaining_records = await this.record_number;
               
               }
                  console.log(user_records)
               console.log("this.total_unique_users") 
           },
            filter_records: async function (auto_filter = false) {
                if (!this.user_records.length && !auto_filter ) {
                    this.alert_msg("Nothing to Filter, Generate records instead")
                    return false;
                } 
                await this.alert_msg("Curently Filtering "+ this.user_records.length +" records... Please wait, This may take few seconds. Be patient....");                   

                    let total_unique_uid = this.total_unique_uid.slice();
                    let total_unique_users = this.total_unique_users.slice();
                    let duplicated = this.duplicated = 0;
                    let unique = this.unique;
                    
                     this.alert_msg("Curently Filtering")
                    let filtered_users = await this.user_records[0].forEach(user => {
                    
                        if (total_unique_users.length >= this.total_requested_records  ) {
                            return false;
                        }

                        if (!total_unique_uid.includes(user.uid)) {
                            total_unique_users.push(user)
                            total_unique_uid.push(user.uid)
                            unique = unique + 1;
                        }else{
                            duplicated = duplicated + 1;
                        }
                          return {unique: total_unique_users, unique_uid: total_unique_uid };
                        })

                          this.total_unique_uid = total_unique_uid.slice();
                          this.total_unique_users = total_unique_users.slice();
                          this.unique = this.total_unique_users.length;
                          this.duplicated =  this.duplicated + duplicated;
                            this.user_records = [];
                            console.log(this.total_unique_users)
                        
                        this.alert_msg("")

                    },
            re_generate_records: async function () {

                 if (this.total_unique_users.length == this.total_requested_records) {
                        this.alert_msg("All your records are balanced. Save records to database ")
                    return false;
                }
                let new_records = [];
                let max_limit = 100000;
                 this.alert_msg("Curently Generating "+ max_limit+" records... Please wait, This may take few seconds. Be patient....")

                let request = await axios.post('http://127.0.0.1:8000/api/test2/random_user_info/',{
                        number: max_limit,
                 }).then(async function (response) {
                       new_records.push(response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    this.user_records = [] = await new_records;
                   await this.filter_records(true);
           
            },
            save_users_records: async function () {
                let total_unique_users = this.total_unique_users;
               if(total_unique_users.length <= 1){
                 this.alert_msg("Saved "+ this.unique +" records to database.. Refresh page, to see all data saved in database....")
               }
                while(total_unique_users.length > 0){

               this.alert_msg("remaining "+ total_unique_users.length  +" records to be saved in database. total records "+this.unique+"... Please wait, This may take few seconds. Be patient....")

                    let limit =await total_unique_users.splice(0, 100);
                    console.log(limit)

                    let request = await axios.post('http://127.0.0.1:8000/api/test2/save_user_info/',{
                    users_info: limit,
                    }).then(async function (response) {
                        console.log(response.data)
                        //    new_records.push(response.data);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
                
            }                  
        },
        // 
    
      }).mount("#app");
    

</script>
@endsection
