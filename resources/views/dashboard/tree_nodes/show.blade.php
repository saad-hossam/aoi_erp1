
@extends('layouts.dashboard.app')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>تفاصيل عنصر القائمة</h4>

        <div>
            <a href="{{ route('admin.tree-nodes.index') }}"
               class="btn btn-secondary">
                رجوع
            </a>

            <a href="{{ route('admin.tree-nodes.edit', ['tree_node' => $node->value]) }}"
               class="btn btn-primary">
                تعديل
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>الكود</th>
                        <td>{{ $node->value }}</td>
                    </tr>

                    <tr>
                        <th>الاسم بالعربي</th>
                        <td>{{ $node->label }}</td>
                    </tr>

                    <tr>
                        <th>الاسم بالإنجليزي</th>
                        <td>{{ $node->label_eng }}</td>
                    </tr>

                    <tr>
                        <th>الأب</th>
                        <td>{{ $node->parent_value }}</td>
                    </tr>

                    <tr>
                        <th>المستوى</th>
                        <td>{{ $node->ilevel }}</td>
                    </tr>

                    <tr>
                        <th>نوع العنصر</th>
                        <td>{{ $node->node_type }}</td>
                    </tr>

                    <tr>
                        <th>حالة العنصر</th>
                        <td>{{ $node->istate }}</td>
                    </tr>

                    <tr>
                        <th>كود الفورم</th>
                        <td>{{ $node->form_code }}</td>
                    </tr>

                    <tr>
                        <th>اسم الـ Object</th>
                        <td>{{ $node->obj_name }}</td>
                    </tr>

                    <tr>
                        <th>نوع النظام</th>
                        <td>{{ $node->sys_type }}</td>
                    </tr>

                    <tr>
                        <th>كود الفرع</th>
                        <td>{{ $node->branch_code }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection