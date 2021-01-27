<?php


namespace App\BackOffice\Users\Domain\Entities;


class UserMenuDto {
    public string $id;
    public string $slug;
    public string $icon;
    public string $name;
    public bool $isParent;
    public bool $isChildren;
    public int $order;
    public string $idParent;
    public array $submenu;

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isParent(): bool
    {
        return $this->isParent;
    }

    /**
     * @param bool $isParent
     */
    public function setIsParent(bool $isParent): void
    {
        $this->isParent = $isParent;
    }

    /**
     * @return bool
     */
    public function isChildren(): bool
    {
        return $this->isChildren;
    }

    /**
     * @param bool $isChildren
     */
    public function setIsChildren(bool $isChildren): void
    {
        $this->isChildren = $isChildren;
    }

    /**
     * @return string
     */
    public function getIdParent(): string
    {
        return $this->idParent;
    }

    /**
     * @param string $idParent
     */
    public function setIdParent(string $idParent): void
    {
        $this->idParent = $idParent;
    }



    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getSubmenu(): array
    {
        return $this->submenu;
    }

    /**
     * @param array $submenu
     */
    public function setSubmenu(array $submenu): void
    {
        $this->submenu = $submenu;
    }




}