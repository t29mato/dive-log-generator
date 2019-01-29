@extends('common')

@section('content')
<div class="row">
    <div class="col-lg-6 offset-md-3">
        <h2>アンケートのお願い</h2>
        <p>
            チームうみねこでは、ダイビングをテーマにWebサービスやスマートフォンアプリを、夜中にこっそりと本業とは別で開発しています。<br><br>
            チームうみねこのサービスとしては「うみねこログ」が１つ目ですが、今後、さらにダイバーのためのサービスを開発できたらと考えています。<br><br>
            より良いサービスを作るために、うみねこログを利用する皆様に教えて欲しいのですが、もしこんなサービスあったら使いたい、や、うみねこログをもっとこうして欲しい。という要望がありましたら、是非是非教えていただけると嬉しいです。<br>
        </p>
        <h2>現在考えているアイデア</h2>
        <p>
            1. 海況速報アプリ<br>
            現地のダイビングサービスと連動して今日の海況情報(オープン・クローズ、透明度など)を教えてくれるサービス<br>
            <br>
            2. ログ管理サービス<br>
            アプリはよくみますが、Webで管理できるダイビングログ管理サービスを作れたら面白いかなと考えています。それで、公開リンクを用意して、たとえばログブックを忘れたバディにダイビング終わりにログが簡単共有できるみたいなのだとどうでしょう。<br>
            <br>
            3. ダイバー専用SNS<br>
            Facebookのコミュニティで事足りるんじゃないかなぁと思っているのですが、こんな機能を持ったダイバー専用のSNSがあったら使いたいですというのがあったら教えて欲しいです。<br>
        </p>
        <h2>アンケートフォーム</h2>
        <p>
            アンケートフォームはこちらです。(Googleフォームに飛びます)<br>
            <a href="https://docs.google.com/forms/d/1P0_IAzYjZ8sUfIOJO6grkGem9PkMNxtymxTca0zB1YM/edit" target="_blank">https://docs.google.com/forms/d/1P0_IAzYjZ8sUfIOJO6grkGem9PkMNxtymxTca0zB1YM/edit</a><br><br>
            アンケートではなくて、直接連絡をいただけるという方は、こちらのTwitterでも大丈夫です。<br>
            <a href="https://twitter.com/t2kmato" target="_blank">https://twitter.com/t2kmato</a>
        </p>
        <h2>その他</h2>
        <p>
            ちなみに、チームうみねこでは、一緒にダイバー向けのサービスを作りたい人を募集しています。<br>
            企画〜開発〜デザインでも、海好きな人なら大歓迎です。<br>まずは一緒に潜りに行きましょう。<br>
            連絡はTwitterでも今回のアンケートフォームでもどちらでも構いません。<br><br>
            もっとちなみに、ダイビングショップやダイビングメーカーの方で、スマホアプリやWebアプリを開発してほしいという方でもお気軽にご連絡ください。<br>
            本業を通してお話を伺いに行きます。笑<br><br>
            2019年1月30日 深夜1時更新
        </p>
        <img src="{{ asset('images/icon-umineco-sleepy.png') }}" height="100" />
    </div>
</div>
@endsection
