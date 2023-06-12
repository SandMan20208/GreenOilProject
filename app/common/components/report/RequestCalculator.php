<?php

namespace common\components\report;
use Cassandra\Date;
use common\components\Utilyty;
use common\models\active_records\Request;
use DateTime;
use yii\db\Query;

class RequestCalculator
{
    private string $dateFrom = '';
    private string $dateTo = '';
    private DateTime $currentDateTime;
    private array $month = [
        1 => 'Январь',
        2 => 'Февраль',
        3 => 'Март',
        4 => 'Апрель',
        5 => 'Май',
        6 => 'Июнь',
        7 => 'Июль',
        8 => 'Август',
        9 => 'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
    ];

    public function __construct()
    {
        $this->currentDateTime = new DateTime();
        $this->dateFrom = (new DateTime())->modify('-3 month')->setTime(0,0)->format('Y-m-d');
        $this->dateTo = (new DateTime())->modify('+2 month')->format('Y-m-d');
    }
    public function calculate(): string
    {
        $requestsByMonths = $this->getRequestByMonths();
        $resultString = '';
        $numberMoth = ((int)($this->currentDateTime->modify('-3 month')->format('n')));
//        for ($i = 0; $i <= 5; $i++) {
//            if (!empty($requestsByMonths[$i])) {
//                $month = $requestsByMonths[$i]['month'] ?? null;
//                $count = $requestsByMonths[$i]['count'] ?? null;
//                if (!$month || !$count) {
//                    continue;
//                }
//                $resultString .= "['{$this->month[$month]}', '$count'], ";
//            } else {
//                $month = $requestsByMonths[$i]['month'] ?? null;
//                $count = $requestsByMonths[$i]['count'] ?? null;
//                $resultString .= "['{$this->month[$month]}', 0], ";
//            }
//
//        }
        foreach ($requestsByMonths as $requestCount) {

            $month = $requestCount['month'] ?? null;
            $count = $requestCount['count'] ?? null;
            if (!$month || !$count) {
                continue;
            }
            $resultString .= "['{$this->month[$month]}', $count], ";
        }
        return $resultString;
    }

    public function getRequestByMonths()
    {
        return (new Query())
            ->select('COUNT(id) as count, MONTH(date(date_created)) as month')
            ->from('request')
            ->andWhere(['>', 'DATE(date_created)', $this->dateFrom])
            ->andWhere(['<', 'DATE(date_created)', $this->dateTo])
            ->groupBy('MONTH(date(date_created))')
            ->orderBy('month', SORT_DESC)
            ->all();
    }

}