<?php
/*
 __    __                                   __       ___     __
/\ \__/\ \                                 /\ \__  /'___\ __/\ \__
\ \ ,_\ \ \___      __         ___   __  __\ \ ,_\/\ \__//\_\ \ ,_\
 \ \ \/\ \  _ `\  /'__`\      / __`\/\ \/\ \\ \ \/\ \ ,__\/\ \ \ \/
  \ \ \_\ \ \ \ \/\  __/     /\ \L\ \ \ \_\ \\ \ \_\ \ \_/\ \ \ \ \_
   \ \__\\ \_\ \_\ \____\    \ \____/\ \____/ \ \__\\ \_\  \ \_\ \__\
    \/__/ \/_/\/_/\/____/     \/___/  \/___/   \/__/ \/_/   \/_/\/__/
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

// Include config file
require_once PATH_THIRD . 'playa_links/config' . EXT;

/**
 * Playa Links
 *
 * @package        Playa Links
 * @author         The Outfit, Inc
 * @link           http://fromtheoutfit.com/playa_links
 */

class Playa_links_ft extends EE_Fieldtype
{
    var $info = array(
        'name'    => PLAYA_LINKS_NAME,
        'version' => PLAYA_LINKS_VERSION,
    );

    /**
     * Install
     *
     * @access public
     * @return array
     */

    function install()
    {
        return array(
            'target' => '_blank',
        );
    }

    /**
     * Display Field
     *
     * @access public
     * @param $data
     * @return mixed
     */

    public function display_field($data)
    {
        // Models & Libraries
        $this->EE->load->model('playa_links_model', 'play_on');
        $this->EE->lang->loadfile('playa_links');
        $this->EE->load->library('table');

        // Variables
        $vars['children']    = array();
        $vars['parents']     = array();
        $vars['field_name']  = $this->field_name;
        $vars['target_type'] = $this->settings['target'];
        $entry_id            = $this->EE->input->get('entry_id');

        // Objects
        $children = $this->EE->play_on->get_children($entry_id);
        $parents  = $this->EE->play_on->get_parents($entry_id);

        // Loop through child results
        if ($children->num_rows() > 0)
        {
            foreach ($children->result() as $child)
            {
                $vars['children'][$child->channel_title][] = array(
                    'entry_id'   => $child->entry_id,
                    'title'      => $child->title,
                    'channel_id' => $child->channel_id,
                );

            }
        }

        // Loop through parent results
        if ($parents->num_rows() > 0)
        {
            foreach ($parents->result() as $parent)
            {
                $vars['parents'][$parent->channel_title][] = array(
                    'entry_id'   => $parent->entry_id,
                    'title'      => $parent->title,
                    'channel_id' => $parent->channel_id,
                );

            }
        }


        return $this->EE->load->view('mod/index', $vars, TRUE);
    }

    /**
     * Saves posted data
     *
     * @param $data
     * @return string
     */
    function save($data)
    {
        return $data;
    }

    /**
     * Displays global settings
     *
     * @access public
     * @return mixed
     */

    public function display_global_settings()
    {
        // Models & Libraries
        $this->EE->lang->loadfile('playa_links');
        $this->EE->load->library('table');

        $val            = array_merge($this->settings, $_POST);
        $target_options = array(
            '_blank' => 'Open in new tab',
            'none'   => 'Open in same window (unsaved data will be lost)',
        );

        $vars['target'] = array('Target', form_dropdown('target', $target_options, $val['target']));

        return $this->EE->load->view('mcp/global_settings', $vars, TRUE);
    }

    /**
     * Saves Global settings
     *
     * @access public
     * @return array
     */

    public function save_global_settings()
    {
        return array_merge($this->settings, $_POST);
    }
}

/* End of file ft.playa_links.php */
/* Location: ./system/expressionengine/third_party/playa_links/ft.playa_links.php */