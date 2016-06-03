import React from 'react';
import ReactDOM from 'react-dom';

var Title = React.createClass({
    render() {
        return (
            <h1>The time is {this.props.date.toTimeString()}</h1>
        );
    }
});

ReactDOM.render(
    <Title date={new Date()}/>, document.getElementById('content'));
