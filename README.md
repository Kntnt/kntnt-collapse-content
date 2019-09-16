# Kntnt's Collapse Content plugin

WordPress-plugin that adds shortcode that collapse content into an accordion.

Adds the shortcode

`[collapse type=… class=… id=… style=… heading_style=… content_style=…]…[/collapse]`

that can be used as illustrated by this example:

    [collapse]
        <h3>First tab</h3>
        <p>Each h3-element is styled as a heading of a tab.</p>
        <p>Everything following an h3-elemnet up to but not including next
           h3-element or the end of the shortcode is treated as the content
           of the tab.</p> 
        <h3>Second tab</h3>
        <p>Thus, this paragraph belongs to the second tab.</p>  
        <h3>Third and last tab</h3>
        <p>Anything can be used as content.</p>
        <ul>
          <li>Paragraphs</li>
          <li>Lists</li>
          <li>Tables</li>
          <li>…</li>
        </ul>
    [/collapse]

All arguments are optional. Some of them have default values (see below).

It is possible to leave out the argument name and the equal sign for arguments
that are in the position indicated by the order of arguments  above. Thus,
following examples are all valid and gives the same result:

    [collapse single]…[/collapse]
    [collapse type="single"]…[/collapse]

Following values are supported by the `type` argument:

* `single` — (default) allows only one tab to be shown at the same time   
* `multiple` — allows several tabs to be shown at the same time 

You might need to add some CSS yourself to make everything look really awesome. For that purpose you can also add following arguments:

* `id` – adds an `id` attribute with the provided value to an outer `<div>` element wrapping the accordion
* `class` – adds a `class` attribute with the provided value to an outer `<div>` element wrapping the accordion
* `style` – adds a `style` attribute with the provided value to an outer `<div>` element wrapping the accordion
* `heading_style` – adds a `style` attribute with the provided value to an inner`<div>` element wrapping the tab heading
* `content_style` – adds a `style` attribute with the provided value to an inner`<div>` element wrapping the tab content
