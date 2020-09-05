@extends('admin.template')

@section('content')
            

            


            @if( count($transactions) >= 1 )
                    @foreach( $transactions->reverse() as $transaction )
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->payable }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td><p>{{ $transaction->tx_id }}</p></td>
                            <td>{{ $transaction->status }}</td>
                            <td>
                            <form action="{{ route('Admin > Transactions > Verify Transaction', $transaction->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="uk-button uk-button-danger uk-float-right" type="button">عدم تایید</button>
                            </form>
                            <form action="{{ route('Admin > Transactions > Verify Transaction', $transaction->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="accept">
                                <button type="submit" class="uk-button uk-button-primary uk-float-left" type="button">تایید</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
            <hr>
            <div>
            {{ $transactions->links('vendor.pagination.uikit') }}
            </div>
            @else
                <p>درخواستی در سامانه ثبت نشده است.</p>
            @endif
@endsection
