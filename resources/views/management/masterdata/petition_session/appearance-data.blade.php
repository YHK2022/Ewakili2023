


    <div  id="no_venue" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th id="table_id" data-priority="1">#</th>
                                            <th id="table_id">Petition Name</th>
                                            <th id="table_id">Petition No</th>
                                            <th id="table_id">Applied On</th>
                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appearanceMembers as $key => $appearanceMember)
                                         @php
                                             $profile = \App\Profile::find($appearanceMember->profile_id);
                                         @endphp
                                        <tr>
                                        <td id="table_id">{{ ++$key }}</td>
                                        <td id="table_id">{{ $profile->fullname }}</td>
                                        <td id="table_id">{{ $appearanceMember->petition_no }}</td>
                                        <td id="table_id"> {{ date('F d, Y', strtotime($appearanceMember->created_at)) }} </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                           </div>

   