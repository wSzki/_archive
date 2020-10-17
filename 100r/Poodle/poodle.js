/* global THREE */
/* global MouseEvent */

function Poodle () {
  this.scale = 50
  this.offset = { x: 0, y: 0 }
  this.bounds = { x: 2000, z: 2000 }
  this.orientation = { x: 0, y: 0, z: 0 }
  this.size = { x: 1, y: 1, z: 1 }
  this.showGrid = false
  this.mode = 'floor'
  this.objects = []

  this.scene = new THREE.Scene()
  this.camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 10000)
  this.renderer = new THREE.WebGLRenderer({ antialias: false, preserveDrawingBuffer: true, logarithmicDepthBuffer: true })
  this.target = new THREE.Line(new THREE.Geometry(), new THREE.MeshBasicMaterial({ color: 0x72dec2 }))
  this.pointer = new THREE.Line(new THREE.Geometry(), new THREE.MeshBasicMaterial({ color: 0xff0000 }))
  this.contact = new THREE.Mesh(new THREE.Geometry(), new THREE.MeshBasicMaterial({ visible: false }))
  this.widget = new THREE.Mesh(new THREE.Geometry(), new THREE.MeshBasicMaterial({ color: 0xff00ff }))
  this.grid = new THREE.GridHelper(40 * this.scale, 20)
  this.raycaster = new THREE.Raycaster()
  this.mouse = new THREE.Vector2()

  this.el = this.renderer.domElement

  this.install = (host = document.body) => {
    this.scene.background = new THREE.Color(0xffffff)
    this.contact.geometry = this._contact()
    this.widget.add(this.widgets())
    this.target.add(this.widget)
    this.contact.add(this.grid)
    this.contact.add(this.target)
    this.objects.push(this.contact)
    this.scene.add(this.pointer)
    this.scene.add(this.contact)

    document.addEventListener('mousemove', this.onMouseMove, false)
    document.addEventListener('mousedown', this.onMouseDown, false)
    document.addEventListener('keydown', this.onKeyDown, false)
    document.addEventListener('keyup', this.onKeyUp, false)

    host.appendChild(this.renderer.domElement)
  }

  this.start = (w, h) => {
    this.grid.material.visible = false
    this.camera.position.set(300, 300, 300)
    this.resize(w, h)
    this.setMode('floor')
    this.focus()
  }

  this.update = () => {
    const msg = `${this.mode} ${this.scale}px`
    if (document.title === msg) { return }
    document.title = msg
  }

  this.guides = (size = this.size, scale = this.scale) => {
    return {
      RTF: new THREE.Vector3(scale * (size.x / 2), scale * (size.y / 2), scale * (size.z / 2)),
      RTB: new THREE.Vector3(scale * (size.x / 2), scale * (size.y / 2), scale * (-size.z / 2)),
      LTF: new THREE.Vector3(scale * (-size.x / 2), scale * (size.y / 2), scale * (size.z / 2)),
      LTB: new THREE.Vector3(scale * (-size.x / 2), scale * (size.y / 2), scale * (-size.z / 2)),
      RBF: new THREE.Vector3(scale * (size.x / 2), -scale * (size.y / 2), scale * (size.z / 2)),
      RBB: new THREE.Vector3(scale * (size.x / 2), -scale * (size.y / 2), scale * (-size.z / 2)),
      LBF: new THREE.Vector3(scale * (-size.x / 2), -scale * (size.y / 2), scale * (size.z / 2)),
      LBB: new THREE.Vector3(scale * (-size.x / 2), -scale * (size.y / 2), scale * (-size.z / 2)),
      RCF: new THREE.Vector3(scale * (size.x / 2), 0, scale * (size.z / 2)),
      LCF: new THREE.Vector3(scale * (-size.x / 2), 0, scale * (size.z / 2)),
      CTF: new THREE.Vector3(0, scale * (size.y / 2), scale * (size.z / 2)),
      CTB: new THREE.Vector3(0, scale * (size.y / 2), scale * (-size.z / 2)),
      RTC: new THREE.Vector3(scale * (size.x / 2), scale / 2, 0),
      CBF: new THREE.Vector3(0, scale * (size.y / 2), scale * (size.z / 2)),
      CBB: new THREE.Vector3(0, scale * (-size.y / 2), scale * (size.z / 2))
    }
  }

  this.add = (pos, geo) => {
    const stepped = new THREE.Vector3().copy(pos).divideScalar(this.scale).floor().multiplyScalar(this.scale).addScalar(this.scale / 2)
    const voxel = new THREE.Line(geo, new THREE.LineBasicMaterial({ color: 0x000000 }))
    voxel.position.set(stepped.x, stepped.y, stepped.z)
    voxel.rotation.x = this.orientation.x
    voxel.rotation.y = this.orientation.y
    voxel.rotation.z = this.orientation.z
    this.scene.add(voxel)
    this.objects.push(voxel)
  }

  this.remove = (pos) => {
    for (const obj of this.objects) {
      if (posEqual(pos, obj.position)) {
        console.log('erase', pos)
        this.scene.remove(obj)
        this.objects.splice(this.objects.indexOf(obj), 1)
        return
      }
    }
  }

  this.delete = () => {
    if (this.objects.length < 2) { return }
    const obj = this.objects[this.objects.length - 1]
    this.scene.remove(obj)
    this.objects.splice(this.objects.length - 1, 1)
  }

  this.focus = () => {
    const pos = new THREE.Vector3().copy(this.target.position)
    this.target.localToWorld(pos)
    this.camera.lookAt(pos)
    this.render()
  }

  this.render = () => {
    this.renderer.render(this.scene, this.camera)
  }

  this.raycast = (x, y) => {
    this.mouse.set((x / this.el.width) * 2 - 1, -(y / this.el.height) * 2 + 1)
    this.raycaster.setFromCamera(this.mouse, this.camera)
    return this.raycaster.intersectObjects(this.objects)
  }

  this.resize = (w, h) => {
    document.location.hash = `#${w}x${h}`
    this.el.width = w
    this.el.height = h
    this.el.style.width = w + 'px'
    this.el.style.height = h + 'px'
    this.center()
    this.camera.aspect = w / h
    this.camera.updateProjectionMatrix()
    this.renderer.setSize(w, h)
  }

  this.center = () => {
    this.offset.x = (window.innerWidth - this.el.width) / 2
    this.offset.y = -(window.innerHeight - this.el.height) / 2
    this.el.setAttribute('style', `left:${parseInt(this.offset.x)}px;top:${-parseInt(this.offset.y)}px`)
  }

  this.toggleGuide = () => {
    this.showGrid = !this.showGrid
    this.grid.material.visible = this.showGrid
    this.render()
  }

  this.setMode = (mode) => {
    this.orientation.x = 0
    this.pointer.rotation.x = this.orientation.x
    this.orientation.y = 0
    this.pointer.rotation.y = this.orientation.y
    this.orientation.z = 0
    this.pointer.rotation.z = this.orientation.z
    this.mode = mode
    this.pointer.geometry = this[`_${mode}`]()
  }

  this.setOrientation = (y = 0, z = 0, x = 0) => {
    this.orientation.x += x * degToRad(90)
    this.pointer.rotation.x = this.orientation.x
    this.orientation.y += y * degToRad(90)
    this.pointer.rotation.y = this.orientation.y
    this.orientation.z += z * degToRad(90)
    this.pointer.rotation.z = this.orientation.z
    this.widget.rotation.x = this.orientation.x
    this.widget.rotation.y = this.orientation.y
    this.widget.rotation.z = this.orientation.z
  }

  this.modScale = (mod = 0) => {
    this.scale = clamp(this.scale + mod, 25, 400)
    this.pointer.geometry = this[`_${this.mode}`]()
  }

  // Shapes

  this._floor = () => {
    const geo = new THREE.Geometry()
    const g = this.guides()
    for (const vertex of [g.RBF, g.RBB, g.LBB, g.LBF, g.RBF]) {
      geo.vertices.push(vertex)
    }
    return geo
  }

  this._ramp = () => {
    const geo = new THREE.Geometry()
    const g = this.guides()
    for (const vertex of [g.RTF, g.RTB, g.LBB, g.LBF, g.RTF]) {
      geo.vertices.push(vertex)
    }
    return geo
  }

  this._edge = () => {
    const geo = new THREE.Geometry()
    const g = this.guides()
    for (const vertex of [g.CTF, g.CTB]) {
      geo.vertices.push(vertex)
    }
    return geo
  }

  this._arc = () => {
    const geo = new THREE.Geometry()
    for (let i = 0; i < 10; i++) {
      const x = -this.scale / 2 + (this.scale * Math.cos(degToRad(10 * i)))
      const y = -this.scale / 2 + (this.scale * Math.sin(degToRad(10 * i)))
      geo.vertices.push(new THREE.Vector3(-this.scale / 2, x, y))
    }
    return geo
  }

  this._contact = () => {
    const geo = new THREE.PlaneBufferGeometry(this.bounds.x, this.bounds.z)
    geo.rotateX(-Math.PI / 2)
    return geo
  }

  this.widgets = () => {
    const obj = new THREE.Line(new THREE.Geometry(), new THREE.MeshBasicMaterial({ color: 0xffffff }))
    const ax = new THREE.Line(new THREE.Geometry(), new THREE.MeshBasicMaterial({ color: 0xff0000 }))
    const ay = new THREE.Line(new THREE.Geometry(), new THREE.MeshBasicMaterial({ color: 0x72dec2 }))
    const az = new THREE.Line(new THREE.Geometry(), new THREE.MeshBasicMaterial({ color: 0xcccccc }))

    const gx = new THREE.Geometry()
    gx.vertices.push(new THREE.Vector3(0, 0, 0))
    gx.vertices.push(new THREE.Vector3(this.scale / 2, 0, 0))
    ax.geometry = gx

    const gy = new THREE.Geometry()
    gy.vertices.push(new THREE.Vector3(0, 0, 0))
    gy.vertices.push(new THREE.Vector3(0, this.scale / 2, 0))
    ay.geometry = gy

    const gz = new THREE.Geometry()
    gz.vertices.push(new THREE.Vector3(0, 0, 0))
    gz.vertices.push(new THREE.Vector3(0, 0, this.scale / 2))
    az.geometry = gz

    obj.add(ax)
    obj.add(ay)
    obj.add(az)
    return obj
  }

  // Events

  this.onMouseMove = (event) => {
    event.preventDefault()
    const intersects = this.raycast(event.layerX, event.layerY)
    if (intersects.length > 0 && intersects[0].face) {
      const intersect = intersects[0]
      this.pointer.position.copy(intersect.point).add(intersect.face.normal)
      this.pointer.position.divideScalar(this.scale).floor().multiplyScalar(this.scale).addScalar(this.scale / 2)
    }
    this.render()
  }

  this.onMouseDown = (event) => {
    event.preventDefault()
    const intersects = this.raycast(event.layerX, event.layerY)
    if (intersects.length > 0) {
      const intersect = intersects[0]
      if (event.shiftKey && intersect.object === this.contact) {
        const pos = new THREE.Vector3().copy(intersect.point).divideScalar(this.scale).floor().multiplyScalar(this.scale).addScalar(this.scale / 2)
        this.remove(pos)
      } else if (intersect.face) {
        const pos = new THREE.Vector3().copy(intersect.point).add(intersect.face.normal)
        const geo = this[`_${this.mode}`]()
        this.add(pos, geo)
      }
    }
    this.render()
  }

  this.onKeyDown = (e) => {
    if (e.key === 'A') {
      this.target.position.x += this.scale
    } else if (e.key === 'D') {
      this.target.position.x -= this.scale
    } else if (e.key === 'W') {
      this.target.position.z += this.scale
    } else if (e.key === 'S') {
      this.target.position.z -= this.scale
    } else if (e.key === 'X') {
      this.contact.position.y += this.scale
    } else if (e.key === 'Z') {
      this.contact.position.y -= this.scale
    } else if (e.key === 'w') {
      this.camera.translateZ(-this.scale)
    } else if (e.key === 's') {
      this.camera.translateZ(this.scale)
    } else if (e.key === 'a') {
      this.camera.translateX(-this.scale)
    } else if (e.key === 'd') {
      this.camera.translateX(this.scale)
    } else if (e.key === 'x') {
      this.camera.position.y += this.scale
    } else if (e.key === 'z') {
      this.camera.position.y -= this.scale
    } else if (e.key === 'r' && e.altKey) {
      this.setOrientation(0, 0, 1)
    } else if (e.key === 'r') {
      this.setOrientation(1, 0)
    } else if (e.key === 'R') {
      this.setOrientation(0, 1)
    } else if (e.key === '1') {
      this.setMode('floor')
    } else if (e.key === '2') {
      this.setMode('ramp')
    } else if (e.key === '3') {
      this.setMode('edge')
    } else if (e.key === '4') {
      this.setMode('arc')
    } else if (e.key === ']') {
      this.modScale(25)
    } else if (e.key === '[') {
      this.modScale(-25)
    }

    if (e.key === 'Tab') {
      e.preventDefault()
    }
    this.update()
    this.focus()
  }

  this.onKeyUp = (e) => {
    e.preventDefault()
    if (e.key === 'e') {
      this.pointer.material.visible = false
      this.target.material.visible = false
      this.grid.material.visible = false
      this.render()
      grab(this.renderer.domElement.toDataURL('image/png'), `poodle${timestamp()}.png`)
      this.pointer.material.visible = true
      this.target.material.visible = true
      this.grid.material.visible = this.showGrid
    } else if (e.key === 'Tab') {
      this.toggleGuide()
    } else if (e.key === 'Backspace') {
      this.delete()
    } else if (e.key === 'q') {
      this.target.position.set(0, 0, 0)
      this.center()
    }
    this.update()
    this.focus()
  }

  // Functions

  function grab (base64, name = 'export.png') {
    const link = document.createElement('a')
    link.setAttribute('href', base64)
    link.setAttribute('download', name)
    link.dispatchEvent(new MouseEvent('click', { bubbles: true, cancelable: true, view: window }))
  }

  function posEqual (a, b) {
    return a.x === b.x && a.y === b.y && a.z === b.z
  }

  function degToRad (deg) {
    return deg * (Math.PI / 180)
  }

  function clamp (val, min, max) {
    return Math.min(max, Math.max(min, val))
  }

  function timestamp () {
    return new Date().toISOString().slice(0, 10).replace(/-/g, '').trim()
  }
}
