@if (count($links) > 0)
    <table class="ui teal selectable celled table">
        <thead>
            <tr>
                <th class="white-space-nowrap">Short URL</th>
                <th class="white-space-nowrap">Created Date</th>
                <th class="white-space-nowrap">Original URL</th>
                <th class="white-space-nowrap">All Clicks</th>
            </tr>
        </thead>

        @foreach ($links as $link)
            <tbody>
                <tr>
                    <td>
                        <a href="{{ route('redirect', $link->code) }}" target="_blank">
                            {{ config('app.url') }}/{{ $link->code }}
                        </a>
                    </td>
                    <td>
                        {{ date("M d, Y", strtotime($link->updated_at)) }}
                    </td>
                    <td>
                        <div class="word-break-all">
                            <a href="{{ $link->link }}" target="_blank">
                                {{ $link->link }}
                            </a>
                        </div>
                    </td>
                    <td>{{ number_format($link->clicks) }}</td>
                </tr>
            </tbody>
        @endforeach

        @if ($links->total() > $links->perPage())
            <tfoot>
                <tr>
                    <th colspan="4">
                        <div class="ui center aligned grid">
                            <div class="row">
                                <div class="column">
                                    @if ($agent->isMobile())
                                        {{ $links->links('vendor.pagination.simple-semantic-ui') }}
                                    @else
                                        {{ $links->links('vendor.pagination.semantic-ui') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </tfoot>
        @endif
    </table>
@else
    <div class="ui center aligned grid">
        <div class="row">
            <div class="column">
                <button class="ui teal basic big button" id="scroll-to-top">Shorten Now</button>
            </div>
        </div>
    </div>
@endif