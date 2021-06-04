<?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()): ?>
<div class="pagination">
    <ul>
    <?php
    if ($this->Paginator->hasPrev()) {
        echo $this->Paginator->prev(
            '« Anterior',
            array(
                'tag' => 'li',
                'class' => 'prev_page',
                'url' => array('s' => 'aergaerg'),
            )
        );
    }

    echo $this->Paginator->numbers(array(
        'separator' => '',
        'modulus' => '4',
        'tag' => 'li',
        'url' => array('s' => 'aergaerg'),
    ));

    if ($this->Paginator->hasNext()) {
        echo $this->Paginator->next(
            'Próxima »',
            array(
                'tag' => 'li',
                'class' => 'next_page',
                'url' => array('s' => 'aergaerg'),
            )
        );
    }
    ?>
    </ul>

    <div class="fix-float"></div>
</div>
<?php endif ?>