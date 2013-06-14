<?php
$data        = form_input($field_name, 1, 'id="' . $field_name . '" style="display: none;"');
$target      = '';

if ($target_type == '_blank')
{
    $target = ' target="_blank"';
}

// If children are present, let's add them to the table.
if (sizeof($children) > 0)
{
    // Start the table
    $this->table->set_template($cp_table_template);
    $this->table->set_heading($child_language);

    foreach ($children as $channel => $entries)
    {
        $children_data = '';
        $children_data .= '<h4 style="margin-left: 0;">' . $channel . '</h4>';
        $children_data .= '<ul>';

        // Loop through the entries
        foreach ($entries as $entry)
        {
            $children_data .= '<li><a href="' . html_entity_decode(BASE) . AMP . 'C=content_publish' . AMP . 'M=entry_form' . AMP . 'channel_id=' . $entry['channel_id'] . '&entry_id=' . $entry['entry_id'] . '"' . $target . '>' . $entry['title'] . '</a></li>';
        }
        $children_data .= '</ul>';
        $this->table->add_row($children_data);
    }


    $data .= $this->table->generate();
}

// If parents are present, let's add them to the table.
if (sizeof($parents) > 0)
{
    // Start the table
    $this->table->set_template($cp_table_template);
    $this->table->set_heading($parent_language);

    foreach ($parents as $channel => $entries)
    {
        $parent_data = '';
        $parent_data .= '<h4 style="margin-left: 0;">' . $channel . '</h4>';
        $parent_data .= '<ul>';

        // Loop through the entries
        foreach ($entries as $entry)
        {
            $parent_data .= '<li><a href="' . html_entity_decode(BASE) . AMP . 'C=content_publish' . AMP . 'M=entry_form' . AMP . 'channel_id=' . $entry['channel_id'] . '&entry_id=' . $entry['entry_id'] . '"' . $target . '>' . $entry['title'] . '</a></li>';
        }

        $parent_data .= '</ul>';
        $this->table->add_row($parent_data);
    }

    $data .= $this->table->generate();
}

echo $data;

/* End of file index.php */
/* Location: ./system/expressionengine/third_party/playa_links/views/mod/index.php */