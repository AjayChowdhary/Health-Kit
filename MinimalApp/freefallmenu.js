function radToDeg(num) {
  return num*180/Math.PI;
}

(function() {

    var MyRenderer = {
      create: function() {
        return { controller: MyRenderer };
      },
      world: function(engine) {
        var cumulativeHeight = 0;
        for (var i=0; i<bodies.length; i++) {
          cumulativeHeight += bodies[i].height
          bodies[i].domelement.style.transform = 'translate3d(0px, '+(bodies[i].position.y-cumulativeHeight+(bodies[i].height/2)-startY)+'px, '+(-bodies[i].position.x)+'px) rotateX('+(radToDeg(bodies[i].angle)-90)+'deg)';
        }
      },
      clear: function(engine) {
      }
    };

    // Matter aliases
    var Engine = Matter.Engine,
        World = Matter.World,
        Bodies = Matter.Bodies,
        Body = Matter.Body,
        Composite = Matter.Composite,
        Composites = Matter.Composites,
        Common = Matter.Common,
        Constraint = Matter.Constraint,
        RenderPixi = Matter.RenderPixi,
        Events = Matter.Events,
        Bounds = Matter.Bounds,
        Vector = Matter.Vector,
        Vertices = Matter.Vertices,
        MouseConstraint = Matter.MouseConstraint,
        Mouse = Matter.Mouse,
        Query = Matter.Query;

    var FreeFallMenu = {};

    var _engine,
        _sceneEvents = [],
        bodies = [],
        endConstraint,
        on = false

    FreeFallMenu.init = function() {

        // Uncomment for debug mode
        var container = document.getElementById('freefallmenu-container');

        var options = {
            positionIterations: 6,
            velocityIterations: 4,
            render: {
              controller: MyRenderer
            }
        };

        _engine = Engine.create(container, options);
        Engine.run(_engine);

        var _world = _engine.world;

        FreeFallMenu.reset();

        var groupId = Matter.Body.nextGroupId();
        var menuElements = document.getElementsByClassName('freefallmenu-element');
        var cumulativeHeight = 0;

        //Bodies
        for (var i=0;i<menuElements.length;i++) {
          var height = menuElements[i].offsetHeight;
          bodies[i] = Bodies.rectangle(0, startY, height, 2.0, {groupId: groupId});
          bodies[i].height = height;
          bodies[i].domelement = menuElements[i];
          cumulativeHeight += bodies[i].height;
          Matter.Body.rotate(bodies[i],-startAngle);
          Matter.Body.translate(bodies[i],{x: (cumulativeHeight-height/2)*Math.cos(startAngle), y: -(cumulativeHeight-height/2)*Math.sin(startAngle)});
          World.add(_world, bodies[i]);
        }

        //Constraints
        var worldPositionConstraintX = (bodies[0].height/2-0.5)*Math.cos(startAngle);
        var worldPositionConstraintY = (bodies[0].height/2-0.5)*Math.sin(startAngle);
        World.add(_world, Constraint.create({
            pointA: { x: 0, y: startY },
            pointB: { x: -worldPositionConstraintX, y: worldPositionConstraintY },
            bodyB: bodies[0],
            stiffness: 1,
        }));
        for (i=0;i<menuElements.length-1;i++) {
          World.add(_world, Constraint.create({
            pointA: { x: (bodies[i].height/2-0.5)*Math.cos(startAngle), y: -(bodies[i].height/2-0.5)*Math.sin(startAngle) },
            pointB: { x: -(bodies[i+1].height/2-0.5)*Math.cos(startAngle), y: (bodies[i+1].height/2-0.5)*Math.sin(startAngle) },
            bodyA: bodies[i],
            bodyB: bodies[i+1],
            stiffness: 1,
          }));
        }
        endConstraint = Constraint.create({
            pointA: { x: cumulativeHeight*Math.cos(startAngle), y: startY-cumulativeHeight*Math.sin(startAngle) },
            pointB: { x: (bodies[bodies.length-1].height/2-0.5)*Math.cos(startAngle), y: -(bodies[bodies.length-1].height/2-0.5)*Math.sin(startAngle) },
            bodyB: bodies[bodies.length-1],
            stiffness: 1,
            length: 0.01,
            angularStiffness: 1,
            render: {
                strokeStyle: '#90EE90',
                lineWidth: 3
            }
        });
        World.add(_world,endConstraint);

        _sceneEvents.push(

            Events.on(_engine, 'beforeUpdate', function(event) {
              if (!on) {
                var engine = event.source;
                var rotX = (bodies[bodies.length-1].height-0.5)*Math.cos(bodies[bodies.length-1].angle)/2;
                var rotY = (bodies[bodies.length-1].height-0.5)*Math.sin(bodies[bodies.length-1].angle)/2;
                var endPoint = Matter.Vector.add(bodies[bodies.length-1].position, {x:rotX, y:rotY});
                var cumulativeHeight = 0;
                for (i=0;i<bodies.length;i++) {
                  cumulativeHeight+=bodies[i].height
                }
                var dest = { x: cumulativeHeight*Math.cos(startAngle), y: startY-cumulativeHeight*Math.sin(startAngle) };
                var dist = Matter.Vector.magnitude(Matter.Vector.sub(dest, endPoint));
                var normal = Matter.Vector.normalise(Matter.Vector.sub(dest, endPoint));
                var vectorToMove = Matter.Vector.add(endPoint, {x:(normal.x*Math.max(dist/50,1)), y:(normal.y*Math.max(dist/70,1))});
                if (dist > 1) {
                  // Moving the menu upwards
                  endConstraint.pointA = vectorToMove;
                }
              }
            })

        );

        // Events
        var dropdownButton = document.getElementById('freefallmenu-button');
        if (dropdownButton.addEventListener) {
            dropdownButton.addEventListener('mouseover', FreeFallMenu.mouseOver);
            dropdownButton.addEventListener('mouseout', FreeFallMenu.mouseOut);
        } else if (dropdownButton.attachEvent) {
            dropdownButton.attachEvent('mouseover', FreeFallMenu.mouseOver);
            dropdownButton.attachEvent('mouseout', FreeFallMenu.mouseOut);
        }
        for (var i=0;i<menuElements.length;i++) {
          var menuElement = menuElements[i];
          if (menuElement.addEventListener) {
              menuElement.addEventListener('mouseover', FreeFallMenu.mouseOver);
              menuElement.addEventListener('mouseout', FreeFallMenu.mouseOut);
          } else if (menuElement.attachEvent) {
              menuElement.attachEvent('mouseover', FreeFallMenu.mouseOver);
              menuElement.addEventListener('mouseout', FreeFallMenu.mouseOut);
          }
        }

    };

    FreeFallMenu.mouseOver = function() {
        on = true;
        endConstraint.pointA = null;
    };

    FreeFallMenu.mouseOut = function() {
        on = false;
    };

    if (window.addEventListener) {
        window.addEventListener('load', FreeFallMenu.init);
    } else if (window.attachEvent) {
        window.attachEvent('load', FreeFallMenu.init);
    }

    var startAngle = 50 * Math.PI/180;
    var startY = 200;

    FreeFallMenu.reset = function() {

        var _world = _engine.world;

        World.clear(_world);
        Engine.clear(_engine);

        var renderController = _engine.render.controller;
        if (renderController.clear)
            renderController.clear(_engine.render);

        for (var i = 0; i < _sceneEvents.length; i++)
            Events.off(_engine, _sceneEvents[i]);
        _sceneEvents = [];

        Common._nextId = 0;

        _engine.enableSleeping = true;

        _mouseConstraint = MouseConstraint.create(_engine);
        World.add(_world, _mouseConstraint);

    };

})();
