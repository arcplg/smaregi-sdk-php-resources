<?php

namespace Arcplg\Smaregi\Tests;

use Arcplg\Smaregi\Smaregi;


class PaymentMethodTest extends TestCase
{

    // public function testAllDeletePaymentMethod() {
    //     $smaregi = new Smaregi();
    //     $paymentMethodList = $smaregi->getPaymentMethods();
    //     foreach ($paymentMethodList as $paymentMethod) {
    //         $delete = $smaregi->deletePaymentMethod($paymentMethod->paymentMethodId);
    //         print_r($delete);
    //     }
    //     return true;
    // }

    // testcreateOrUpdatePaymentMethodをテストする
    /** @test 
     * @return mixed
     */
    public function testcreateOrUpdatePaymentMethod() {
        $smaregi = new Smaregi();
        $value = [
            ["paymentMethodCode" => "SK0001", "paymentMethodName" => "現金", "group" => "現金"],
            ["paymentMethodCode" => "SK0002", "paymentMethodName" => "ＶＩＳＡ商品券(返品なし）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0003", "paymentMethodName" => "ＪＣＢ商品券（返品なし）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0004", "paymentMethodName" => "ＵＣ商品券(返品なし）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0005", "paymentMethodName" => "ＤＣ商品券(返品なし）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0006", "paymentMethodName" => "地域商品券1000", "group" => "商品券"],
            ["paymentMethodCode" => "SK0007", "paymentMethodName" => "モール商品券(返品なし）1000", "group" => "商品券"],
            ["paymentMethodCode" => "SK0008", "paymentMethodName" => "モール商品券(返品なし）500", "group" => "商品券"],
            ["paymentMethodCode" => "SK0009", "paymentMethodName" => "その他商品券(返品なし）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0010", "paymentMethodName" => "ＶＩＳＡ商品券（返品あり）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0011", "paymentMethodName" => "ＪＣＢ商品券(返品あり）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0012", "paymentMethodName" => "ＵＣ商品券(返品あり）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0013", "paymentMethodName" => "ＤＣ商品券(返品あり）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0014", "paymentMethodName" => "モール商品券(返品あり）1000", "group" => "商品券"],
            ["paymentMethodCode" => "SK0015", "paymentMethodName" => "モール商品券(返品あり）500", "group" => "商品券"],
            ["paymentMethodCode" => "SK0016", "paymentMethodName" => "その他商品券(返品あり）", "group" => "商品券"],
            ["paymentMethodCode" => "SK0017", "paymentMethodName" => "自社商品券", "group" => "商品券"],
            ["paymentMethodCode" => "SK0018", "paymentMethodName" => "割増商品券", "group" => "商品券"],
            ["paymentMethodCode" => "SK0019", "paymentMethodName" => "VISAクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0020", "paymentMethodName" => "JCBクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0021", "paymentMethodName" => "モデルクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0022", "paymentMethodName" => "オリエントクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0023", "paymentMethodName" => "MUFJクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0024", "paymentMethodName" => "楽天クレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0025", "paymentMethodName" => "DCクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0026", "paymentMethodName" => "UCクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0027", "paymentMethodName" => "セディナクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0028", "paymentMethodName" => "シティックスクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0029", "paymentMethodName" => "ジャックスクレジット", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0030", "paymentMethodName" => "デビットカード", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0031", "paymentMethodName" => "クレディセゾン", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0032", "paymentMethodName" => "アメリカンエキスプレス", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0033", "paymentMethodName" => "ダイナース", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0034", "paymentMethodName" => "三菱UFJニコス", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0035", "paymentMethodName" => "MASTER", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0036", "paymentMethodName" => "日専連/イオン", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0037", "paymentMethodName" => "ギンレン", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0038", "paymentMethodName" => "その他", "group" => "クレジット"],
            ["paymentMethodCode" => "SK0039", "paymentMethodName" => "売掛（代引）", "group" => "売掛"],
            ["paymentMethodCode" => "SK0040", "paymentMethodName" => "売掛（振込）", "group" => "売掛"],
            ["paymentMethodCode" => "SK0041", "paymentMethodName" => "売掛（給与引き）", "group" => "売掛"],
            ["paymentMethodCode" => "SK0042", "paymentMethodName" => "売掛（QR決済）", "group" => "売掛"],
            ["paymentMethodCode" => "SK0043", "paymentMethodName" => "小切手", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0044", "paymentMethodName" => "電子マネー", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0045", "paymentMethodName" => "モールポイント", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0046", "paymentMethodName" => "交通系IC", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0047", "paymentMethodName" => "ワオン", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0048", "paymentMethodName" => "Edy", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0049", "paymentMethodName" => "iD", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0050", "paymentMethodName" => "&mall", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0051", "paymentMethodName" => "QR決済", "group" => "その他・電子マネー"],
            ["paymentMethodCode" => "SK0052", "paymentMethodName" => "VISAカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0053", "paymentMethodName" => "JCBカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0054", "paymentMethodName" => "モデルカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0055", "paymentMethodName" => "オリコカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0056", "paymentMethodName" => "MUFJカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0057", "paymentMethodName" => "楽天カード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0058", "paymentMethodName" => "セディナカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0059", "paymentMethodName" => "シティックスカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0060", "paymentMethodName" => "ジャックスカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0061", "paymentMethodName" => "デビットカード", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0062", "paymentMethodName" => "三菱UFJニコス", "group" => "クレジット連動"],
            ["paymentMethodCode" => "SK0063", "paymentMethodName" => "その他", "group" => "クレジット連動"],
        ];

        $groups = $smaregi->getPaymentMethodGroups();
        // $valueをループして$groupsのnameと一致したらidを取得する
        foreach ($value as $key => $val) {
            foreach ($groups as $group) {
                if ($val['group'] == $group->name) {
                    $value[$key]['paymentMethodGroupId'] = $group->paymentMethodGroupId;
                    unset($value[$key]['group']);
                }
            }
            // 返品なしという文言がpaymentMethodNameに含まれる場合はchangeFlag = 0とする
            if (strpos($val['paymentMethodName'], '返品なし') !== false) {
                $value[$key]['changeFlag'] = "0";
            } else {
                $value[$key]['changeFlag'] = "1";
            }
        }
        foreach ($value as $key => $val) {
            $create = $smaregi->createOrUpdatePaymentMethod($val);
            print_r($create);
        }
        return $this->assertEquals(200, $create['status_code']);
    }
}
