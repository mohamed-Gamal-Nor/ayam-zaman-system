
<table>
    <thead>
        <tr>
            <th colspan="11">قائمة الموظفين كاملة تضم المفعلين وغير المفعلين</th>
        </tr>
    </thead>
    <thead>
        <tr>
            <th class="border-bottom-0">#</th>
            <th class="border-bottom-0">البصمة</th>
            <th class="border-bottom-0">اسم الموظف</th>
            <th class="border-bottom-0">الهاتف</th>
            <th class="border-bottom-0">العنوان</th>
            <th class="border-bottom-0">الرقم القومي</th>
            <th class="border-bottom-0">النوع</th>
            <th class="border-bottom-0">الراتب</th>
            <th class="border-bottom-0">صرف الراتب</th>
            <th class="border-bottom-0">الوظيفة</th>
            <th class="border-bottom-0">الحالة</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;?>
        @foreach ($employees  as $key => $employee)
            <?php $i++?>
            <tr>
                <td >{{$i}}</td>
                <td>{{ $employee->employees_finger }}</td>
                <td>{{ $employee->employees_name }}</td>
                <td>{{ $employee->employees_phone }}</td>
                <td>{{ $employee->employees_address }}</td>
                <td>{{ $employee->employees_nationalID }}</td>
                <td>{{ $employee->employees_gender }}</td>
                <td>{{ $employee->employees_salary }}</td>
                <td>{{ $employee->date_salary }}</td>
                <td>{{ $employee->employees_jopName }}</td>
                <td >{{$employee->stauts }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
