=== WP Floating Menu Framework ===
Contributors: Kimiya Kitani
Tags: mime,file extention
Requires at least: 4.0
Tested up to: 4.0
Stable tag: 1.0.0

This is the Japanese translation.

このプラグインは、フローティングメニューを設定するためのフレームワークです。
 
== Description ==

このプラグインは、フローティングメニューを設定するためのフレームワークです。

下記の３つのテーマではテストしましたが、完全に動作させる保証はしません。
テーマは様々なレベルでカスタマイズされていること、筆者はCSSやJavaScriptにあまり詳しくないためです。

動作しない、挙動がおかしい場合には後述する仕組みを参考に、floating-menu.jsやテーマを編集してください。

- Twenty Eleven
- Twenty Twelve
- Twenty Thirteen

== Installation ==

1. プラグインをインストールして有効化にする
2. 設定の「Floating Menu設定」より利用したいJavaScriptを有効にして選択する

もしJavaScriptファイルをご自身の環境に適応させるため、カスマイズしたい場合には
jsフォルダ内のtemplatesフォルダ以下にあるテンプレートを、jsフォルダにコピーしてリネームし、
JavaScript内のname, page, adminbarなどの値を編集してください。

= Usage =

基本的に、「ウェブページ全体のid」と「フローティングメニューのid」を見つけるか設定してください（divとかnavとかで）。

例）Twenty Thirteenテーマのグローバルナビゲーションバーをフローティングメニューにしたい場合

floating-menu.js を編集して、name, page, adminbarに対して下記の値を設定してください。
- var name = "#navbar";
- var page = "#page";
- var adminbar = "#wpadminbar";

name変数
フローティングメニューにしたいidに対して、「position: absolute」を設定し、またフローティングメニューまわりを制御するために使われます。

page変数
ウェブページのmargin-topに関する調整をします。

adminbar変数
ログインユーザーのうち、上部にアドミンバーを表示させている場合に対する調整です。

例）HTML構成例

もし下記の値を設定しているなら、
- "name" = "navigation-bar"
- "page" = "page"
HTML構成は下記であるべきです。

<body>
<div id="page">
...
  <div id="navigation-bar">
    .....
    .....
  </div>
...
</div>
</body>


== Frequently Asked Questions ==

= Twenty Tenテーマでは挙動がおかしい =

うーむ、どうやらこのテーマではうまく動作しないみたいですね。
その次のバージョンから、div id="page"が設定されていたのですが、そういうものが設定されていないのが原因かもしれません。

== Changelog ==

= 1.0.0 =
* First Released.
