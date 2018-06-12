@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Audit</div>

                    <div class="panel-body">
                        <p class="pull-left">Total {{ $audit_list->total() }}</p>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>date</th>
                                    <th>user</th>
                                    <th>ip</th>
                                    <th>screen</th>
                                    <th>tag</th>
                                    <th colspan="2">description</th>
                                    <th class="hide">details</th>
                                    <th class="hide">changes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($audit_list as $audit)
                                    <tr>
                                        <td data-target="created_at">{{ $audit->created_at }}</td>
                                        <td data-target="user_name">{{ $audit->user_name }}</td>
                                        <td data-target="ip">{{ $audit->ip }}</td>
                                        <td data-target="screen">{{ $audit->screen }}</td>
                                        <td data-target="tag">{{ $audit->tag }}</td>
                                        <td data-target="description">{{ $audit->description }}</td>
                                        <td><button type="button" class="btn btn-primary btn-xs" id="open-modal-audit-details">Detalhes</button></td>
                                        <td data-target="details" class="hide">{{ $audit->details }}</td>
                                        <td data-target="changes" class="hide">{{ $audit->changes }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">It's empty yet!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <center>{{ $audit_list->links() }}</center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal-audit-details" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Audit</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Date:</td>
                                <td><b id="date-audit-details"></b></td>
                                <td>IP:</td>
                                <td><b id="ip-audit-details"></b></td>
                            </tr>
                            <tr>
                                <td>User:</td>
                                <td><b id="user-audit-details"></b></td>
                                <td>Screen:</td>
                                <td><b id="screen-audit-details"></b></td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td><b id="description-audit-details"></b></td>
                                <td>Tag:</td>
                                <td><b id="tag-audit-details"></b></td>
                            </tr>
                            <tr>
                                <!-- <td></td> -->
                                <td colspan="4" id="details-audit-details"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section('script')
    <script type="text/javascript">
        $(function(){
            $(document).on('click', '#open-modal-audit-details', function(event) {
                event.preventDefault();
                $("#modal-audit-details").modal('show');

                var tr = $(this).closest('tr');
                var created_at = tr.find('td[data-target="created_at"]').html();
                var user_name = tr.find('td[data-target="user_name"]').html();
                var ip = tr.find('td[data-target="ip"]').html();
                var screen = tr.find('td[data-target="screen"]').html();
                var tag = tr.find('td[data-target="tag"]').html();
                var description = tr.find('td[data-target="description"]').html();
                var details = tr.find('td[data-target="details"]').html();
                var changes = tr.find('td[data-target="changes"]').html();
                
                $('#user-audit-details').html(user_name);
                $('#ip-audit-details').html(ip);
                $('#description-audit-details').html(description);
                $('#tag-audit-details').html(tag);
                $('#screen-audit-details').html(screen);
                $('#date-audit-details').html(created_at);
                $('#details-audit-details').html(get_details(details, changes));
            });

            /**
             * Prepara a tabela de detalhes
             * @param  {json} details 
             * @return {string} table_details
             */
            function get_details(details, changes) {

                var object = $.parseJSON(details);
                var changes = (changes) ? $.parseJSON(changes) : null;
                var table_details = '<br>';
                table_details += '<table class="table table-bordered">';
                table_details +=  '<thead>';
                table_details +=    '<tr>';
                table_details +=     '<th colspan="2">Details</th>';
                if (changes) {
                    table_details += '<th>changes</th>';
                }
                table_details +=    '</tr>';
                table_details +=   '</thead>';
                table_details +=  '<tbody>';
                $.each(object, function(index, val) {
                    table_details += '<tr>';
                    table_details +=  '<td>' + index + ':</td>';
                    table_details +=  '<td><b>' + val + '</b></td>';
                    if (changes) {
                        if (changes[index]) {
                            table_details += '<td><b>' + changes[index] + '</b></td>';
                        } else {
                            table_details += '<td></td>';
                        }
                    }
                    table_details += '</tr>';
                });
                table_details +=  '</tbody>';
                table_details += '</table>';
                return table_details;
            }
        });
    </script>
@endsection