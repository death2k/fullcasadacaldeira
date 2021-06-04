<?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()): ?>
<div class="pagination">
    <ul>
    <?php
    if ($this->Paginator->hasPrev()) {
        echo $this->Paginator->prev(
            '« Anterior',
            array('class' => 'prev', 'tag' => 'li')
        );
    }

    echo $this->Paginator->numbers(array(
        'separator' => '',
        'modulus' => '4',
        'tag' => 'li',
    ));

    if ($this->Paginator->hasNext()) {
        echo $this->Paginator->next(
            'Próxima »',
            array('class' => 'next', 'tag' => 'li')
        );
    }
    ?>
    </ul>
</div>
<?php endif ?>