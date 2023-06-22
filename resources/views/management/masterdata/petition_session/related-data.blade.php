<!-- related_data.blade.php -->

<p style="font-size: 20px; color: #1a9138; font-weight: bold; margin-bottom: 10px; padding-left: 20px;">
                                       Total coram available
</p>
<h6> CLE Committee</h6>
<table style="width: 100%; border-collapse: collapse;">
    <thead style="background-color: #ac1515;">
        <tr>
            <th style="width: 50px; height: 40px; border: 1px solid #000; padding: 8px;">S/N</th>
            <th style="width: 150px; height: 40px; border: 1px solid #000; padding: 8px;">Name</th>
            <th style="width: 100px; height: 40px; border: 1px solid #000; padding: 8px;">Title</th>
            <th style="width: 150px; height: 40px; border: 1px solid #000; padding: 8px;">Total Reviewed</th>
            <!-- Add more table headers for the related data fields -->
        </tr>
    </thead>
    <tbody>
        @foreach($coramCleMembers as $key => $coramCleMember)
        @php
            $cle = \App\Models\Masterdata\CleMember::find($coramCleMember->cle_member_id);
            $user_name = \App\User::find($cle->user_id);
         @endphp
        <tr style="height: 30px;">
            <td style="width: 50px; border: 1px solid #000; padding: 8px;">{{ ++$key }}</td>
            <td style="width: 150px; border: 1px solid #000; padding: 8px;">{{ $user_name->full_name }}</td>
            <td style="width: 100px; border: 1px solid #000; padding: 8px;">
                @if($cle->title == 2) <span>MEMBER</span>
                 @elseif ($cle->title == 1)<span>SECRETARY</span>
                @endif
            </td>
            <td style="width: 150px; border: 1px solid #000; padding: 8px;">{{ $coramCleMember->member_id }}</td>
            <!-- Add more table cells for the related data fields -->
        </tr>
        @endforeach
        <tr style="height: 30px;">
            <td colspan="3" style="text-align: left; border: 1px solid #000; padding: 8px;"><strong>Grand Total:</strong></td>
            <td style="width: 150px; border: 1px solid #000; padding: 8px;">{{ $totalReviewed }}</td>
        </tr>
    </tbody>
</table>

