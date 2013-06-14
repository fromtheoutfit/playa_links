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

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

// config
require_once PATH_THIRD . 'playa_links/config' . EXT;

/**
 * Playa Links Model
 *
 * @package        Playa Links
 * @category       model
 * @author         The Outfit, Inc
 * @link           http://fromtheoutfit.com/playa_links
 * @copyright      Copyright (c) 2012 - 2013, The Outfit, Inc.
 */

class Playa_links_model
{

    public function __construct()
    {
        // ee super object
        $this->EE      =& get_instance();
        $this->site_id = $this->EE->config->item('site_id');

        // comment out the following line to enable caching
        $this->EE->db->cache_off();
    }

    /**
     * Get child relationships from Playa entry
     *
     * @access public
     * @param int $entry_id
     * @return string
     */

    public function get_children($entry_id)
    {
        $this->EE->db->select('c.channel_title, c.channel_id, ct.title, ct.entry_id');
        $this->EE->db->from('playa_relationships AS pr');
        $this->EE->db->join('channel_titles AS ct', 'ct.entry_id = pr.child_entry_id');
        $this->EE->db->join('channels AS c', 'c.channel_id = ct.channel_id');
        $this->EE->db->where('pr.parent_entry_id', $entry_id);
        $this->EE->db->where('ct.site_id', $this->site_id);
        $this->EE->db->order_by('c.channel_title', 'asc');
        $this->EE->db->order_by('ct.title', 'asc');

        return $this->EE->db->get();
    }

    /**
     * Get parent relationships from Playa entry
     *
     * @access public
     * @param int $entry_id
     * @return string
     */

    public function get_parents($entry_id)
    {
        $this->EE->db->select('c.channel_title, c.channel_id, ct.title, ct.entry_id');
        $this->EE->db->from('playa_relationships AS pr');
        $this->EE->db->join('channel_titles AS ct', 'ct.entry_id = pr.parent_entry_id');
        $this->EE->db->join('channels AS c', 'c.channel_id = ct.channel_id');
        $this->EE->db->where('pr.child_entry_id', $entry_id);
        $this->EE->db->where('ct.site_id', $this->site_id);
        $this->EE->db->order_by('c.channel_title', 'asc');
        $this->EE->db->order_by('ct.title', 'asc');

        return $this->EE->db->get();
    }

    /**
     * Check to see if Playa is installed
     *
     * @access public
     * @return boolean
     */

    public function playa_installed()
    {
        $this->EE->db->where('name', 'playa');
        $q = $this->EE->db->get('fieldtypes');

        if ($q->num_rows() == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }


}

/* End of file playa_links_model.php */
/* Location: ./system/expressionengine/third_party/playa_links/models/playa_links_model.php */