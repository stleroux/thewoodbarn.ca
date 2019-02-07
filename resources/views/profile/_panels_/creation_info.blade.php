<div class="panel panel-default">
    <div class="panel-heading">Date(s)</div>
    <div class="panel-body">
        <table>
            <tr>
                <th width='120px'>Created on</th>
                <td align='right'>{{ date('M j, Y', strtotime($user->created_at)) }}</td>
            </tr>
            <tr>
                <th>Updated on</th>
                <td align='right'>{{ date('M j, Y', strtotime($user->updated_at)) }}</td>
            </tr>
        </table>
    </div>
</div>
