
<table>
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>{{number_format($supplierBalance[0],2)}}</th>
            <th colspan="2">رصيد بداية المدة </th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>{{$supplierName[0]}}</th>
            <th colspan="2">أسم المورد</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>{{$start}}</th>
            <th colspan="2">من الفترة</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>{{$end}}</th>
            <th colspan="2">ألي الفترة</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>{{number_format($invoicesSum,2)}}</th>
            <th colspan="2">اجمالي مشتريات خلال الفترة</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>{{number_format($invoicesReturnsSum,2)}}</th>
            <th colspan="2">اجمالي مرتجعات خلال الفترة</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>{{number_format($supllierPaysSum,2)}}</th>
            <th colspan="2">اجمالي السداد خلال الفترة</th>
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
            <th >#</th>
            <th >التاريخ</th>
            <th>رقم الفاتورة / رقم السداد</th>
            <th>البيان</th>
            <th>مدين</th>
            <th>دائن</th>
            <th>الرصيد</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;?>
        @foreach ($results as  $result)
        <?php $i++?>
            <tr>
                <th>{{$i}}</th></th>
                <th>{{$results->statment}}</th>
                <th>{{$sumInvoicesReturnsBalance}}</th>
                <th>{{$sumPayBalance}}</th>
            </tr>
        @endforeach
    </tbody>
</table>


