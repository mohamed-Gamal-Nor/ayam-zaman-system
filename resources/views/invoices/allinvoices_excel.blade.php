
<table>
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr class="text-center">
            <th >#</th>
            <th >رقم الفاتورة</th>
            <th>تاريخ الفاتورة</th>
            <th>اسم المورد</th>
            <th>المخزن</th>
            <th>اجمالي المجموع</th>
            <th>الخصم</th>
            <th>اجمالي المجموع بعد الخصم</th>
            <th>نسبة الضريبة</th>
            <th>قيمة الضريبة</th>
            <th>اجمالي الفاتورة</th>
            <th>ملاحظات الفاتورة</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;?>
        @foreach ($invoices as $invoice)
            <?php $i++?>
            <tr class="text-center">
                <td>{{ $i }}</td>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->invoice_Date }}</td>
                <td>{{ $invoice->supplier->supplier_name }}</td>
                <td>{{ $invoice->store->stores_name }}</td>
                <td>{{ $invoice->sub_total }}</td>
                <td>{{$invoice->discount}}</td>
                <td>{{$invoice->sub_total_disc}}</td>
                <td>{{$invoice->rate_vat * 100}} %</td>
                <td>{{$invoice->value_vat}}</td>
                <td>{{$invoice->total}}</td>
                <td>{{$invoice->note}}</td>
            </tr>
        @endforeach
    </tbody>
</table>


