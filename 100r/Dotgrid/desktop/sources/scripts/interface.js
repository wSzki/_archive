'use strict'

function Interface (client) {
  this.el = document.createElement('div')
  this.el.id = 'interface'

  this.el.appendChild(this.menu_el = document.createElement('div'))
  this.menu_el.id = 'menu'

  this.isVisible = true
  this.zoom = false

  this.install = function (host) {
    host.appendChild(this.el)
  }

  this.start = function (host) {
    let html = ''
    const options = {
      cast: {
        line: { key: 'A', icon: 'M60,60 L240,240' },
        arc_c: { key: 'S', icon: 'M60,60 A180,180 0 0,1 240,240' },
        arc_r: { key: 'D', icon: 'M60,60 A180,180 0 0,0 240,240' },
        bezier: { key: 'F', icon: 'M60,60 Q60,150 150,150 Q240,150 240,240' },
        close: { key: 'Z', icon: 'M60,60 A180,180 0 0,1 240,240  M60,60 A180,180 0 0,0 240,240' }
      },
      toggle: {
        linecap: { key: 'Q', icon: 'M60,60 L60,60 L180,180 L240,180 L240,240 L180,240 L180,180' },
        linejoin: { key: 'W', icon: 'M60,60 L120,120 L180,120  M120,180 L180,180 L240,240' },
        thickness: { key: '', icon: 'M120,90 L120,90 L90,120 L180,210 L210,180 Z M105,105 L105,105 L60,60 M195,195 L195,195 L240,240' },
        mirror: { key: 'E', icon: 'M60,60 L60,60 L120,120 M180,180 L180,180 L240,240 M210,90 L210,90 L180,120 M120,180 L120,180 L90,210' },
        fill: { key: 'R', icon: 'M60,60 L60,150 L150,150 L240,150 L240,240 Z' }
      },
      misc: {
        color: { key: 'G', icon: 'M150,60 A90,90 0 0,1 240,150 A-90,90 0 0,1 150,240 A-90,-90 0 0,1 60,150 A90,-90 0 0,1 150,60' }
      },
      source: {
        open: { key: 'c-O', icon: 'M155,65 A90,90 0 0,1 245,155 A90,90 0 0,1 155,245 A90,90 0 0,1 65,155 A90,90 0 0,1 155,65 M155,95 A60,60 0 0,1 215,155 A60,60 0 0,1 155,215 A60,60 0 0,1 95,155 A60,60 0 0,1 155,95 ' },
        render: { key: 'c-R', icon: 'M155,65 A90,90 0 0,1 245,155 A90,90 0 0,1 155,245 A90,90 0 0,1 65,155 A90,90 0 0,1 155,65 M110,155 L110,155 L200,155 ' },
        export: { key: 'c-E', icon: 'M155,65 A90,90 0 0,1 245,155 A90,90 0 0,1 155,245 A90,90 0 0,1 65,155 A90,90 0 0,1 155,65 M110,140 L110,140 L200,140 M110,170 L110,170 L200,170' },
        save: { key: 'c-S', icon: 'M155,65 A90,90 0 0,1 245,155 A90,90 0 0,1 155,245 A90,90 0 0,1 65,155 A90,90 0 0,1 155,65 M110,155 L110,155 L200,155 M110,185 L110,185 L200,185 M110,125 L110,125 L200,125' },
        grid: { key: 'H', icon: 'M65,155 Q155,245 245,155 M65,155 Q155,65 245,155 M155,125 A30,30 0 0,1 185,155 A30,30 0 0,1 155,185 A30,30 0 0,1 125,155 A30,30 0 0,1 155,125 ' }
      }
    }

    for (const type in options) {
      const tools = options[type]
      for (const name in tools) {
        const tool = tools[name]
        html += `
        <svg 
          id="option_${name}" 
          title="${capitalize(name)}" 
          onmouseout="client.interface.out('${type}','${name}')" 
          onmouseup="client.interface.up('${type}','${name}')" 
          onmousedown="client.interface.down('${type}','${name}', event)" 
          onmouseover="client.interface.over('${type}','${name}')" 
          viewBox="0 0 300 300" 
          class="icon ${type}">
          <path id="${name}_path" class="icon_path" d="${tool.icon}"/>${name === 'depth' ? '<path class="icon_path inactive" d=""/>' : ''}
          <rect ar="${name}" width="300" height="300" opacity="0">
            <title>${capitalize(name)}${tool.key ? '(' + tool.key + ')' : ''}</title>
          </rect>
        </svg>`
      }
    }
    this.menu_el.innerHTML = html
    this.menu_el.appendChild(client.picker.el)
  }

  this.over = function (type, name) {
    client.cursor.operation = {}
    client.cursor.operation[type] = name
    this.update(true)
    client.renderer.update(true)
  }

  this.out = function (type, name) {
    client.cursor.operation = ''
    client.renderer.update(true)
  }

  this.up = function (type, name) {
    if (!client.tool[type]) { console.warn(`Unknown option(type): ${type}.${name}`, client.tool); return }

    this.update(true)
    client.renderer.update(true)
  }

  this.down = function (type, name, event) {
    if (!client.tool[type]) { console.warn(`Unknown option(type): ${type}.${name}`, client.tool); return }
    const mod = event.button === 2 ? -1 : 1
    client.tool[type](name, mod)
    this.update(true)
    client.renderer.update(true)
  }

  this.prev_operation = null

  this.update = function (force = false, id) {
    if (this.prev_operation === client.cursor.operation && force === false) { return }

    let multiVertices = null
    const segments = client.tool.layer()
    const sumSegments = client.tool.length()

    for (const i in segments) {
      if (segments[i].vertices.length > 2) { multiVertices = true; break }
    }

    document.getElementById('option_line').className.baseVal = !client.tool.canCast('line') ? 'icon inactive' : 'icon'
    document.getElementById('option_arc_c').className.baseVal = !client.tool.canCast('arc_c') ? 'icon inactive' : 'icon'
    document.getElementById('option_arc_r').className.baseVal = !client.tool.canCast('arc_r') ? 'icon inactive' : 'icon'
    document.getElementById('option_bezier').className.baseVal = !client.tool.canCast('bezier') ? 'icon inactive' : 'icon'
    document.getElementById('option_close').className.baseVal = !client.tool.canCast('close') ? 'icon inactive' : 'icon'

    document.getElementById('option_thickness').className.baseVal = client.tool.layer().length < 1 ? 'icon inactive' : 'icon'
    document.getElementById('option_linecap').className.baseVal = client.tool.layer().length < 1 ? 'icon inactive' : 'icon'
    document.getElementById('option_linejoin').className.baseVal = client.tool.layer().length < 1 || !multiVertices ? 'icon inactive' : 'icon'
    document.getElementById('option_mirror').className.baseVal = client.tool.layer().length < 1 ? 'icon inactive' : 'icon'
    document.getElementById('option_fill').className.baseVal = client.tool.layer().length < 1 ? 'icon inactive' : 'icon'

    document.getElementById('option_color').children[0].style.fill = client.tool.style().color
    document.getElementById('option_color').children[0].style.stroke = client.tool.style().color
    document.getElementById('option_color').className.baseVal = 'icon'

    // Source

    document.getElementById('option_save').className.baseVal = sumSegments < 1 ? 'icon inactive source' : 'icon source'
    document.getElementById('option_export').className.baseVal = sumSegments < 1 ? 'icon inactive source' : 'icon source'
    document.getElementById('option_render').className.baseVal = sumSegments < 1 ? 'icon inactive source' : 'icon source'

    document.getElementById('option_grid').className.baseVal = client.renderer.showExtras ? 'icon inactive source' : 'icon source'

    // Grid
    if (client.renderer.showExtras) { document.getElementById('grid_path').setAttribute('d', 'M65,155 Q155,245 245,155 M65,155 Q155,65 245,155 M155,125 A30,30 0 0,1 185,155 A30,30 0 0,1 155,185 A30,30 0 0,1 125,155 A30,30 0 0,1 155,125 ') } else { document.getElementById('grid_path').setAttribute('d', 'M65,155 Q155,245 245,155 M65,155 ') }

    // Mirror
    if (client.tool.style().mirror_style === 0) { document.getElementById('mirror_path').setAttribute('d', 'M60,60 L60,60 L120,120 M180,180 L180,180 L240,240 M210,90 L210,90 L180,120 M120,180 L120,180 L90,210') } else if (client.tool.style().mirror_style === 1) { document.getElementById('mirror_path').setAttribute('d', 'M60,60 L240,240 M180,120 L210,90 M120,180 L90,210') } else if (client.tool.style().mirror_style === 2) { document.getElementById('mirror_path').setAttribute('d', 'M210,90 L210,90 L90,210 M60,60 L60,60 L120,120 M180,180 L180,180 L240,240') } else if (client.tool.style().mirror_style === 3) { document.getElementById('mirror_path').setAttribute('d', 'M60,60 L60,60 L120,120 L180,120 L210,90 M240,240 L240,240 L180,180 L120,180 L90,210') } else if (client.tool.style().mirror_style === 4) { document.getElementById('mirror_path').setAttribute('d', 'M120,120 L120,120 L120,120 L180,120 M120,150 L120,150 L180,150 M120,180 L120,180 L180,180 L180,180 L180,180 L240,240 M120,210 L120,210 L180,210 M120,90 L120,90 L180,90 M60,60 L60,60 L120,120  ') }

    this.prev_operation = client.cursor.operation
  }

  this.toggle = function () {
    this.isVisible = !this.isVisible
    this.el.className = this.isVisible ? 'visible' : 'hidden'
  }

  document.onkeydown = function (e) {
    if (e.key === 'Tab') {
      client.interface.toggle()
      e.preventDefault()
    }
  }

  function capitalize (str) {
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase()
  }
}
