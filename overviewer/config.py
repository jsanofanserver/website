def markerFilter(poi):
    if poi['id'] == 'Marker':
        return poi['name']

worlds["vanilla"] = "/home/jfs/vanilla/world"

renders["vanillanorth"] = {
    "world": "vanilla",
    "title": "North",
    "rendermode": smooth_lighting,
    "dimension": "overworld",
    "manualpois":[
                   {'id':'Marker',
                    'x':565,
                    'y':64,
                    'z':534,
                    'name':'Shop Town'},
                   {'id':'Marker',
                    'x':3323,
                    'y':85,
                    'z':585,
                    'name':'Jungle Spawn'}],
    "markers": [dict(name="Markers", filterFunction=markerFilter, icon="icons/marker_town.png", checked=True)],
}

renders["vanillasouth"] = {
    "world": "vanilla",
    "title": "South",
    "rendermode": smooth_lighting,
    "dimension": "overworld",
    "northdirection": "lower-right",
    "manualpois":[
                   {'id':'Marker',
                    'x':565,
                    'y':64,
                    'z':534,
                    'name':'Shop Town'},
                   {'id':'Marker',
                    'x':3323,
                    'y':85,
                    'z':585,
                    'name':'Jungle Spawn'}],
    "markers": [dict(name="Markers", filterFunction=markerFilter, icon="icons/marker_town.png", checked=True)],
}

outputdir = "/var/www/html/overviewer"
texturepath = "/var/www/html/overviewer/1.10.jar"
