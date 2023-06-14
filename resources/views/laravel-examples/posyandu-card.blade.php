@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Kartu Posyandu</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form method="POST" action="{{ route('kartu-posyandu.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="posyanducard-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">
                                            No.
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">
                                            Bulan
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">
                                            Tgl
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">
                                            BB (kg)
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">
                                            TB (cm)
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">
                                            Umur
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="3">
                                            Status Gizi
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">
                                            Imunisasi
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">
                                            Vit A
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            BB/U
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            TB/U
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            BB/TB
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $index => $item) 
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->month }}</p>
                                        </td>
                                        <td class="text-center">
                                            <input type="date" name="date[]" id="date_{{ $index + 1 }}" class="text-xs font-weight-bold" value="{{ $item->date }}" style="width: 120px;">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" min="1" placeholder="BB" name="weight[]" id="bb_{{ $index + 1 }}" value="{{ $item->weight }}" class="text-xs font-weight-bold" style="width: 50px;" onkeyup="weightHeightChange('{{ $index + 1 }}')">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" min="1" placeholder="TB" name="height[]" id="tb_{{ $index + 1 }}" value="{{ $item->height }}" class="text-xs font-weight-bold" style="width: 50px;" onkeyup="weightHeightChange('{{ $index + 1 }}')">
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $age }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0" id="bb-u-{{ $index + 1 }}">{{ $item->weight ? round($item->weight / $age, 2) : 0 }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0" id="tb-u-{{ $index + 1 }}">{{ $item->height ? round($item->height / $age, 2) : 0 }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0" id="bb-tb-{{ $index + 1 }}">{{ ($item->weight && $item->height) ? round($item->weight / $item->height, 2) : 0 }}</p>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" onchange="immunizationChange(event, '{{ $index + 1 }}')">
                                            <input type="hidden" name="immunization[]" id="immunization_{{ $index + 1 }}" value="{{ $item->immunization }}">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" onchange="vitAChange(event, '{{ $index + 1 }}')">
                                            <input type="hidden" name="vit_a[]" id="vit_a_{{ $index + 1 }}" value="{{ $item->vit_a }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="m-3 d-flex justify-content-end">
                            <button class="btn bg-gradient-primary btn-sm mb-0">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const age = '{{ $age }}';
    const items = JSON.parse('{!! $items !!}');

    items.forEach((item, index) => {
        const immunizationCheckEl = document.querySelector(`#immunization_${index + 1}`).previousElementSibling;
        const vitACheckEl = document.querySelector(`#vit_a_${index + 1}`).previousElementSibling;

        immunizationCheckEl.checked = item.immunization;
        vitACheckEl.checked = item.vit_a;
    });

    const currentTableData = document.querySelectorAll(`#posyanducard-table tbody tr:nth-child(${new Date().getMonth() + 1}) td`);

    currentTableData.forEach((td) => {
        td.style.backgroundColor = 'rgba(155, 229, 170, .4)';
        td.style.color = '#000';
    });

    const nextCurrentTableRows = document.querySelectorAll(`#posyanducard-table tbody tr:nth-child(n + ${new Date().getMonth() + 2})`);
    
    nextCurrentTableRows.forEach((tr) => {
        const inputs = tr.querySelectorAll('input');

        inputs.forEach((input) => {
            input.disabled = true;
        });
    });

    const weightHeightChange = (key) => {
        const weight = Number(document.querySelector(`#bb_${key}`).value) || 0;
        const height = Number(document.querySelector(`#tb_${key}`).value) || 0;
        const bbUEl = document.querySelector(`#bb-u-${key}`);
        const tbUEl = document.querySelector(`#tb-u-${key}`);
        const bbTbEl = document.querySelector(`#bb-tb-${key}`);

        const bbU = weight / age;
        const tbU = height / age;
        const bbTb = (weight / height) === Infinity || !(weight / height) ? 0 : (weight / height);

        bbUEl.innerText = Number.isInteger(bbU) ? bbU : bbU.toFixed(2);
        tbUEl.innerText = Number.isInteger(tbU) ? tbU : tbU.toFixed(2);
        bbTbEl.innerText = Number.isInteger(bbTb) ? bbTb : bbTb.toFixed(2);
    }

    const immunizationChange = (event, key) => {
        const immunizationEl = document.querySelector(`#immunization_${key}`);
        immunizationEl.value = event.target.checked ? 1 : 0;
    }

    const vitAChange = (event, key) => {
        const vitAEl = document.querySelector(`#vit_a_${key}`);
        vitAEl.value = event.target.checked ? 1 : 0;
    }
</script>
@endsection