<?php

    $data = '';

    // Start the table
    $this->table->set_template($cp_table_template);
    $this->table->set_heading(array(lang('playa_links_setting'),lang('playa_links_preference')));

    // Add rows for each of the link types
    $this->table->add_row($child_language);
    $this->table->add_row($parent_language);

    // Generate the table
    $data .= $this->table->generate();

    echo $data;

/* End of file index.php */
/* Location: ./system/expressionengine/third_party/playa_links/views/mcp/display_settings.php */