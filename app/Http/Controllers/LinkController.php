<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\LinkInfo;
use Jenssegers\Agent\Agent;

class LinkController extends Controller
{
    /* 首頁 */
    public function index(Request $request)
    {
        $agent = new Agent();

        LinkController::chargeNewCode(10);

        $links = Link::
            select('links.code', 'links.link', 'links.updated_at', 'link_infos.clicks')
            ->join('link_infos', 'links.id', '=', 'link_infos.id')
            ->where('links.user_ip', $request->ip())
            ->orderBy('links.id', 'desc')
            ->paginate(10);

        $new_link = Link::
            where('id', session('status'))
            ->value('code');

        if ($request->ajax()) {
            return view('link.part', [
                'agent' => $agent,
                'links' => $links,
            ]);
        }

        return view('index', [
            'agent' => $agent,
            'links' => $links,
            'new_link' => $new_link,
        ]);
    }

    /* 產生連結 */
    public function generate(Request $request)
    {
        $prepared_link = Link::
            where('status', 0)
            ->orderBy('id')
            ->first();

        $this->validate($request, [
            'link' => 'required|max:255|url|active_url',
        ]);
        
        $prepared_link->update([
            'link' => $request->input('link'),
            'status' => '1',
            'user_ip' => $request->ip(),
        ]);

        return back()->with('status', $prepared_link->id);
    }

    /* 導向連結 */
    public function redirect($code)
    {
        $redirect_link = Link::
            where([
                ['code', $code],
                ['status', '1'],
            ])
            ->first();

        if ($redirect_link) {
            LinkInfo::where('id', $redirect_link->id)->increment('clicks');

            return redirect($redirect_link->link);
        } else {
            abort(404);
        }
    }

    /* 補充連結 */
    public static function chargeNewCode($number)
    {
        if (Link::where('status', 0)->count() < $number) {
            for ($i = 1; $i <= $number; $i++) {
                $links = new Link;
                $links->code = LinkController::getRandomCode(5);
                $links->save();

                $link_infos = new LinkInfo;
                $link_infos->save();
            }

            LinkController::destroyDuplicateCode();
        }
    }

    /* 取得代碼 */
    public static function getRandomCode($length) {
        $bytes = openssl_random_pseudo_bytes($length * 2);

        return substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $length);
    }

    /* 刪除重複代碼 */
    public static function destroyDuplicateCode() {
        $duplicate_codes = Link::
            selectRaw('`code`, count(`code`)')
            ->groupBy('code')
            ->havingRaw('count(`code`) > 1')
            ->pluck('code')
            ->all();

        if (count($duplicate_codes) > 0) {
            foreach ($duplicate_codes as $duplicate_code) {
                $links = Link::
                    where('code', $duplicate_code)
                    ->pluck('id')
                    ->all();
                
                foreach ($links as $link) {
                    Link::
                        where('id', $link)
                        ->delete();

                    LinkInfo::
                        where('id', $link)
                        ->delete();
                }
            }
        }
    }
}
