<?php

namespace App\Http\Traits;


trait RawQuery
{

    public function generateRawQuery($keywords, $fieldName)
    {
        $searchTerms = explode(' ', $keywords);
        $searchTermBits = array();
        foreach ($searchTerms as $term) {
            $term = trim($term);
            if (!empty($term)) {
                $searchTermBits[] = "{$fieldName} LIKE '%$term%'";
            }
        };
        $fullQuery = implode(' AND ', $searchTermBits);
        $fullQueryOR = implode(' OR ', $searchTermBits);
        $query = "($fullQueryOR)
                ORDER BY
                     CASE
                     WHEN {$fieldName} LIKE '" . $keywords . "' THEN 1
                     WHEN {$fieldName} LIKE '" . $keywords . "%' THEN 2
                     WHEN {$fieldName} LIKE '%" . $keywords . "%' THEN 3
                     WHEN {$fieldName} LIKE '%" . $keywords . "' THEN 4
                     WHEN " . $fullQuery . " THEN 5
                     ELSE 6
                     END
                ";
        return $query;
    }
}
