<?php


namespace App\Shared\Domain\Entities;


class PaginateEntity
{
    public array $rows = [];
    public int $countRows = 0;
    public int $currentPage = 0;
    public int $limitRows = 0;
    public int $totalPerPages = 0;

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param array $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }

    /**
     * @return int
     */
    public function getCountRows(): int
    {
        return $this->countRows;
    }

    /**
     * @param int $countRows
     */
    public function setCountRows(int $countRows): void
    {
        $this->countRows = $countRows;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return int
     */
    public function getLimitRows(): int
    {
        return $this->limitRows;
    }

    /**
     * @param int $limitRows
     */
    public function setLimitRows(int $limitRows): void
    {
        $this->limitRows = $limitRows;
    }

    /**
     * @return int
     */
    public function getTotalPerPages(): int
    {
        return $this->totalPerPages;
    }

    /**
     * @param int $totalPerPages
     */
    public function setTotalPerPages(int $totalPerPages): void
    {
        $this->totalPerPages = $totalPerPages;
    }

}