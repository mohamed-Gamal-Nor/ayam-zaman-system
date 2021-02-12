
<table>
    <thead>
        <tr>
            <th colspan="11">قائمة العملاء كاملة </th>
        </tr>
    </thead>
    <thead>
        <tr>
            <th class="border-bottom-0">#</th>
            <th class="border-bottom-0">اسم العميل</th>
            <th class="border-bottom-0">البريد الالكتروني</th>
            <th class="border-bottom-0">الهاتف</th>
            <th class="border-bottom-0"> العنوان</th>
            <th class="border-bottom-0">النوع</th>
            <th class="border-bottom-0">تاريخ الانشاء</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;?>
        @foreach ($customers  as $key => $customer)
            <?php $i++?>
            <tr>
                <td >{{$i}}</td>
                <td>{{ $customer->customers_name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->customers_phone }}</td>
                <td>{{ $customer->customers_address }}</td>
                <td>{{ $customer->customers_gender }}</td>
                <td>{{ $customer->created_at }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
