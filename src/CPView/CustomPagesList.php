<?php

namespace App\CPView;


/**
 * Class CustomPagesList
 * @package App\CPView
 */
class CustomPagesList extends \ISPager\View
{
    /**
     * @param \ISPager\Pager $pager
     * @return string
     */
    public function render(\ISPager\Pager $pager) {

        // Объект постраничной навигации
        $this->pager = $pager;

        // Строка для возвращаемого результата
        $return_page = "";

        // Текущий номер страницы
        $current_page = $this->pager->getCurrentPage();
        // Общее количество страниц
        $total_pages = $this->pager->getPagesCount();

        if(($current_page != 1) && ($current_page - $this->pager->getVisibleLinkCount() > 1)) {
            $return_page .= $this->link('1', 1)." ... ";
        }

        // Выводим предыдущие элементы
        if($current_page > $this->pager->getVisibleLinkCount() + 1) {
            $init = $current_page - $this->pager->getVisibleLinkCount();
            for($i = $init; $i < $current_page; $i++) {
                $return_page .= $this->link($i, $i)." ";
            }
        } else {
            for($i = 1; $i < $current_page; $i++) {
                $return_page .= $this->link($i, $i)." ";
            }
        }
        // Выводим текущий элемент
        $return_page .= "$i ";
        // Выводим следующие элементы
        if($current_page + $this->pager->getVisibleLinkCount() < $total_pages) {
            $cond = $current_page + $this->pager->getVisibleLinkCount();
            for($i = $current_page + 1; $i <= $cond; $i++) {
                $return_page .= $this->link($i, $i)." ";
            }
        } else {
            for($i = $current_page + 1; $i <= $total_pages; $i++) {
                $return_page .= $this->link($i, $i)." ";
            }
        }

        if(($current_page != $total_pages) && ($current_page + $this->pager->getVisibleLinkCount() < $total_pages)) {
            $return_page .= " ... ".$this->link($total_pages, $total_pages);
        }

        return $return_page;
    }
}