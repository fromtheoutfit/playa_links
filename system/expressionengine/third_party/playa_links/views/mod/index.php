<?php
$data = form_input($field_name, 1, 'id="'.$field_name.'" style="display: none;"');
$target = '';

if ($target_type == '_blank')
{
    $target = ' target="_blank"';
}

// If children are present, let's add them to the table.
if (sizeof($children) > 0)
{
    // Start the table
    $this->table->set_template($cp_table_template);
    $this->table->set_heading(lang('playa_links_child_entries'));

    foreach ($children as $channel => $entries)
    {
        $this->table->add_row('<strong>' . $channel . '</strong>');

        // Loop through the entries
        foreach ($entries as $entry)
        {
            $this->table->add_row('<a href="' . html_entity_decode(BASE) . AMP . 'C=content_publish' . AMP . 'M=entry_form' . AMP . 'channel_id=' . $entry['channel_id'] . '&entry_id=' . $entry['entry_id'] . '"' . $target . '>' . $entry['title'] . '</a>');
        }
    }

    $data .= $this->table->generate();
}

// If parents are present, let's add them to the table.
if (sizeof($parents) > 0)
{
    // Start the table
    $this->table->set_template($cp_table_template);
    $this->table->set_heading(lang('playa_links_parent_entries'));

    foreach ($parents as $channel => $entries)
    {
        $this->table->add_row('<strong>' . $channel . '</strong>');

        // Loop through the entries
        foreach ($entries as $entry)
        {
            $this->table->add_row('<a href="' . html_entity_decode(BASE) . AMP . 'C=content_publish' . AMP . 'M=entry_form' . AMP . 'channel_id=' . $entry['channel_id'] . '&entry_id=' . $entry['entry_id'] . '"' . $target . '>' . $entry['title'] . '</a>');
        }
    }

    $data .= $this->table->generate();
}

echo $data;

/* End of file index.php */
/* Location: ./system/expressionengine/third_party/playa_links/views/mod/index.php */