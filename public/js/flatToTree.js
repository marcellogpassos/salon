var isRootNode = function (node) {
    return node.parent == null;
};

var isNodeParent = function (parent, children) {
    return children.parent == parent.id;
};

var setNodeChildrens = function (node, childrens) {
    node.childrens = childrens;
};

var getNodeChildrens = function (node) {
    return node.childrens;
};

var getRootNodes = function (flat) {
    var rootNodes = [];
    for (var i = 0; i < flat.length; i++) {
        if (isRootNode(flat[i])) {
            var node = flat.splice(i--, 1)[0];
            rootNodes.push(node);
        }
    }
    return rootNodes;
};

var getDirectChildrens = function (flat, parent) {
    var childrens = [];
    for (var i = 0; i < flat.length; i++) {
        if (isNodeParent(parent, flat[i])) {
            var children = flat.splice(i--, 1)[0];
            childrens.push(children);
        }
    }
    return childrens;
};

var getDescendants = function (flat, parent) {
    var childrens = getDirectChildrens(flat, parent);
    if (childrens.length > 0) {
        setNodeChildrens(parent, childrens);
        for (var i = 0; i < childrens.length; i++)
            getDescendants(flat, getNodeChildrens(parent)[i]);
    } else
        setNodeChildrens(parent, null);
};

var flatToTree = function (flat) {
    var tree = [];
    var rootNodes = getRootNodes(flat);
    tree.push(rootNodes);
    for (var i = 0; i < rootNodes.length; i++)
        getDescendants(flat, rootNodes[i]);
    return tree;
};