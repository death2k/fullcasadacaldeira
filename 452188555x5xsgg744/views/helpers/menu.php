<?php
class MenuHelper extends HtmlHelper {
    public function mount($menuItens, $activeMenu = '') {
        $output = '';

        foreach($menuItens AS $nome => $opcoes):
            //Se não passou a url, define a padrão...
            $link = isset($opcoes['url']) ?
                $opcoes['url'] : array('controller' => $nome);
            
            if(is_array($link)):
                //Define a action padrão...
                if(!isset($link['action'])) $link['action'] = 'index';

                //Define o prefixo admin como padrão...
                if(!isset($link['admin'])) $link['admin'] = true;
            endif;


            $params = Router::getParams();
            
            //Verifica se este item é o ativo...
            /*$active = ($nome == $activeMenu || $nome == $params['controller'])
                      ? 'active' : '';*/
            
            $active = ($nome == $activeMenu) ? 'active' : '';


            //Define as opções padrões do link...
            if(!isset($opcoes['link_options']))
                $opcoes['link_options'] = array();
            
            if(!isset($opcoes['link_options']['class']))
                $opcoes['link_options']['class'] = '';

            
            //Define as opções padrões do li...
            if(!isset($opcoes['li_options']))
                $opcoes['li_options'] = array();
            
            if(isset($opcoes['li_options']['class'])):
                $opcoes['li_options']['class'] .= ' ' . $active;
            else:
                $opcoes['li_options']['class'] = $active;
            endif;


            //Monta o submenu...
            $subMenu = '';
            if(isset($opcoes['subItens'])):
                $opcoes['li_options']['class'] .= ' dropdown';
                $opcoes['link_options']['class'] .= ' dropdown-toggle';

                $subMenu = $this->mount($opcoes['subItens'], $params['controller']);
                $subMenu = $this->tag('ul', $subMenu, array(
                    'class' => 'dropdown-menu'
                ));
            endif;


            //Verifica se o item é um divisor...
            if($opcoes['label'] == 'divider'):
                $linkHtml = '';
                $opcoes['li_options']['class'] .= ' divider';
            else:
                $linkHtml = $this->link(
                    $opcoes['label'],
                    $link,
                    $opcoes['link_options']
                );
            endif;


            //Monta o conteúdo do item...
            $liContent = $linkHtml . $subMenu;


            $output .= $this->tag('li', $liContent, $opcoes['li_options']);
        endforeach;

        return $output;
    }
}