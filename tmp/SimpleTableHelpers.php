<?php


namespace App\Components;


use T4\Core\Std;

class SimpleTableHelpers
{
    /**
     * @param string|Std $filters can be encoded json string or decoded into Std object
     * @return string statement for WHERE clause
     */
    public static function filtersToStatement($filters)
    {
        if (empty($filters)) {
            return '';
        }

        $statements = [
            'IN_LIST' => '%s IN (%s)',
            'NOT_IN_LIST' => '%s NOT IN (%s)',
            'EQ' => '%s = \'%s\'',
            'NE' => '%s <> \'%s\'',
            'LT' => '%s < %s',
            'LE' => '%s <= %s',
            'GT' => '%s > %s',
            'GE' => '%s >= %s',
            'STARTING' => '%s LIKE \'%s%%\'',
            'ENDING' => '%s LIKE \'%%%s\'',
            'INCLUDING' => '%s LIKE \'%%%s%%\''
        ];
        $emptyStatements = [
            'ADD_EMPTY' => '%s IS NULL OR \'%s\' = \'\'',
            'REMOVE_EMPTY' => '%s IS NOT NULL AND %s <> \'\'',
        ];
        if (is_string($filters) === true) {
            $filters = json_decode($filters);
            $filters = new Std($filters);
        }

        $resultStatements = [];
        function wrapper($item)
        {
            return '\'' . $item .'\'';
        }
        function wrapper2($item)
        {
            return '(' . $item .')';
        }
        foreach ($filters as $accessor => $filter) {
            $statementForAccessor = [];
            $value = array_map(function($item) {return '\'' . $item .'\'';}, $filter->value->toArray());
            switch ($filter->type) {
                case 'IN_LIST':
                    if (count($value) === 0) {
                        array_push($resultStatements, 'false');
                        break;
                    }
                    array_push($statementForAccessor, sprintf($statements[$filter->type], $filter->filterBy, implode(', ', $value)));
                    if (true ===$filter->addEmpty) {
                        array_push($statementForAccessor, sprintf($emptyStatements['ADD_EMPTY'], $filter->filterBy, $filter->filterBy));
                    }
                    array_push($resultStatements, implode(' OR ', $statementForAccessor));
                    break;
                case 'NOT_IN_LIST':
                    array_push($statementForAccessor, sprintf($statements[$filter->type], $filter->filterBy, implode(', ', $value)));
                    if (true ===$filter->removeEmpty) {
                        array_push($statementForAccessor, sprintf($emptyStatements['REMOVE_EMPTY'], $filter->filterBy, $filter->filterBy));
                    }
                    array_push($resultStatements, implode(' AND ', $statementForAccessor));
                    break;
                default:
                    $filterArray = $filter->value->toArray();
                    $filterValue = array_pop($filterArray);
                    array_push($resultStatements, sprintf($statements[$filter->type], $filter->filterBy, $filterValue));
            }
        }
        if (count($resultStatements) === 0) {
            return '';
        } elseif (count($resultStatements) === 1) {
            return array_pop($resultStatements);
        } else {
            $result = array_map(function($item) {return '(' . $item .')';}, $resultStatements);
            $resSt = implode(' AND ', $result);
            return $resSt;
        }
    }

    /**
     * @param string|Std $pagination can be encoded json string or decoded into Std object
     * @return string statement like OFFSET xx LIMIT xx
     */
    public static function paginationToStatement($pagination)
    {
        if (empty($pagination)) {
            return '';
        }
        $pagination = new Std(json_decode($pagination));
        return is_int($pagination->offset) && is_int($pagination->limit)
            ? 'OFFSET ' . $pagination->offset . ' LIMIT ' . $pagination->limit
            : '';
    }

    /**
     * @param string|Std $sorting can be encoded json string or decoded into Std object
     * @return string statement ORDER BY
     */
    public static function sortingToStatement($sorting)
    {
        if (empty($sorting) || !$sorting instanceof Std) {
            return '';
        }
        $statement = [];
        $sorting = $sorting->toArray();
        foreach ($sorting as $key => $val) {
            $val = json_decode($val, true);
            $statement[] =  array_keys($val)[0] . ' ' . array_values($val)[0];
        }
        return count($statement) === 0 ? '' : 'ORDER BY ' . implode(', ', $statement);
    }

}